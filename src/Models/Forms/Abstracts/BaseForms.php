<?php namespace Btybug\Resources\Models\Forms\Abstracts;

/**
 * Created by PhpStorm.
 * User: Sahak
 * Date: 8/3/2016
 * Time: 8:46 PM
 */
use File;
use Form;
use Validator;

abstract class BaseForms
{
    public $filds;
    public $rules;
    private $id;
    private $type;
    private $legend;
    private $function;
    private $dir;
    private $path;
    private $rule_types = [
        'text' => ['required', 'unique:table', 'max:num', 'min:num', 'numeric', 'alpha', 'alpha_dash', 'email', 'alpha_num', 'url', 'string'],
        'password' => ['required', 'max:num', 'min:num', 'confirmed'],
        'email' => ['required', 'email', 'unique:table'],
        'file' => ['required', 'size:num', 'mimes:file_formats']
    ];

    public function __construct()
    {
        $this->dir = base_path('forms/');
    }

    public static function __callStatic($name, $arguments)
    {
        $method = 'scope' . ucfirst($name);
        $_this = new static;
        if (method_exists($_this, $method)
            && is_callable(array($_this, $method))
        ) {
            return call_user_func_array([$_this, 'scope' . ucfirst($name)], $arguments);
        }
    }

    public function __call($name, $arguments)
    {
        $method = 'scope' . ucfirst($name);
        if (method_exists($this, $method)
            && is_callable(array($this, $method))
        ) {
            return call_user_func_array([$this, 'scope' . ucfirst($name)], $arguments);
        }
    }

    protected function scopeRender($id = null)
    {
        if ($id) {
            return $this->find($id)->generator();
        }
        return $this->generator();
    }

    private function generator()
    {
        $html = Form::open(['class' => 'form-horizontal']);
        $html .= Form::hidden('form_id', $this->id);
        $html .= "<legend>$this->legend</legend>";

        foreach ($this->filds as $filed => $data) {

            $function = $data['type'];
            if (method_exists($this, $function)) {
                $html .= $this->$function($filed, $data);
            }

        }
        $html .= '<div class="form-group"><label class="col-md-4 control-label" for="textinput"></label><div class="col-md-4">';
        $html .= Form::submit('Save', ['class' => 'btn btn-primary']);
        $html .= '</div></div>';
        $html .= Form::close();
        return $html;
    }

    private function text($name, $data)
    {
        $html = '<div class="form-group"><label class="col-md-4 control-label" for="textinput">' . $data['lable'] . '</label><div class="col-md-4">';
        $html .= Form::text($name, null, $data);
        $html .= '</div></div>';
        return $html;
    }

    private function email($name, $data)
    {
        $html = '<div class="form-group"><label class="col-md-4 control-label" for="textinput">' . $data['lable'] . '</label><div class="col-md-4">';
        $html .= Form::email($name, null, $data);
        $html .= '</div></div>';
        return $html;

    }

    private function password($name, $data)
    {
        $html = '<div class="form-group"><label class="col-md-4 control-label" for="textinput">' . $data['lable'] . '</label><div class="col-md-4">';
        $html .= Form::password($name, $data);
        $html .= '</div></div>';
        return $html;

    }

    private function file($name, $data)
    {
        $html = '<div class="form-group"><label class="col-md-4 control-label" for="textinput">' . $data['lable'] . '</label><div class="col-md-4">';
        $html .= Form::file($name, $data);
        $html .= '</div></div>';
        return $html;

    }

    private function scopeValidation($request)
    {
        $_this = $this->scopeFind($request->get('form_id'));
        $validator = Validator::make($request->all(), $_this->rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        };
    }

    public function scopeFind($id)
    {
        $this->path = $this->dir . $id . ".json";
        if (File::exists($this->path)) {
            $json = json_decode(File::get($this->path), true);
            $this->id = $json['id'];
            $this->type = $json['type'];
            $this->legend = $json['legend'];
            $this->function = $json['function'];
            $this->filds = $json['filds'];
            $this->rules = $json['rules'];
        }
        return $this;
    }

    private function scopeFieldsLists($id = null)
    {
        if ($id) {
            $form = $this->scopeFind($id);
        } else {
            $form = $this;
        }
        $html = '<div class="list-group col-md-4">';
        foreach ($form->filds as $key => $value) {
            $type = $value['type'];
            $html .= "<button type='button' class='list-group-item form-items' value=$key data-type=$type >$key (type:$type)</button>";
        }
        $html .= '</div>';
        return $html;
    }

    private function scopeTypeRules($type)
    {
        if (isset($this->rule_types[$type])) {
            $html = '<div class="form-group"><label class="col-md-4 control-label" for="textinput">Select Rule</label><div class="col-md-12">';
            $html .= Form::select(null, [null => 'Select'] + $this->rule_types[$type], null, ['class' => 'form-control', 'id' => 'validation']);
            $html .= '</div></div>';
            return $html;
        }

    }

    private function scopeRuler($rule)
    {
        $data = explode(':', $rule);
        if (isset($data[1])) {
            $function = $data[1];
            return $this->$function() . '<label class="col-md-12 control-label" for="singlebutton">&nbsp;</label><div class="col-md-12"><button id="add-rule" class="btn btn-info">add</button></div>';
        }
        return '<label class="col-md-12 control-label" for="singlebutton">&nbsp;</label><div class="col-md-12">
<button id="add-rule" class="btn btn-info">add</button>
</div>';
    }

    private function table()
    {
        $tables = [null => 'Select Table', 'users' => 'User', 'users_profile' => 'User Profile'];
        $html = '<div class="form-group"><label class="col-md-8 control-label" for="textinput">Select Table</label><div class="col-md-12">';
        $html .= Form::select(null, $tables, null, ['class' => 'form-control', 'id' => 'rule_attr']);
        $html .= '</div></div>';
        return $html;
    }

    private function num()
    {
        $tables = [null => 'Select Table', 'users' => 'User', 'users_profile' => 'User Profile'];
        $html = '<div class="form-group"><label class="col-md-8 control-label" for="textinput">Select Count</label><div class="col-md-12">';
        $html .= Form::input('number', null, 1, ['class' => 'form-control', 'min' => 1, 'id' => 'rule_attr']);
        $html .= '</div></div>';
        return $html;
    }

    private function file_formats()
    {
        $formats = ['Images' => [
            'JPG' => 'JPG',
            'PNG' => 'PNG',
            'JPEG' => 'JPEG',
            'BMP ' => 'BMP',
            'MAC' => 'MAC',
            'PSD' => 'PSD',
        ],
            'Documents' => [
                'PDF' => 'PDF',
                'DOCX' => ' DOCX',
                'PPTX' => ' PPTX',
                'DOX' => ' DOX',
            ]
        ];


        $html = '<div class="form-group"><label class="col-md-8 control-label" for="textinput">Select Table</label><div class="col-md-12">';
        $html .= Form::select(null, $formats, null, ['class' => 'form-control', 'id' => 'rule_attr', 'multiple' => 'multiple']);
        $html .= '</div></div>';
        return $html;
    }

    private function scopeValidatorJson($id = null)
    {
        if ($id) {
            $form = $this->scopeFind($id);
        } else {
            $form = $this;
        }
        $json = [];
        if (empty($this->rules)) {

            foreach ($this->filds as $key => $value) {
                $json[$key] = [];
            }
        } else {
            $json = $this->rules;
        }
        $json = json_encode($json, true);

        $html = '<div class="col-md-12 form-group">';
        $html .= "<textarea readonly class='form-control' id='jaon-data' data-id=$id data-json='" . $json . "' >$json</textarea>";
        $html .= '<div>';
        return $html;
    }

    private function scopeRulerSave($request)
    {
        $form = $this->scopeFind($request->get('id'));
        if ($form) {
            $data = File::get($form->path);
            $data = json_decode($data, true);
            if ($request->has('rules')) {
                $rules = $request->get('rules');
                foreach ($rules as $k => $v) {
                    foreach ($v as $key => $value) {
                        if (empty($value)) {
                            unset($rules[$k][$key]);
                        }
                    }
                }
                $data['rules'] = $rules;
                if (File::put($form->path, json_encode($data, true))) {
                    return 'Validation save successful';
                }
            }

        }
        return 'Error';
    }

}