<?php namespace Btybug\Resources\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Resources\Models\Files\FileUpload;
use App\Modules\Resources\Models\UnitUpload;
use App\Modules\Resources\Models\Validation as validateUpl;
use File;
use Illuminate\Http\Request;
use Resources;
use Sahakavatar\Cms\Models\Templates\Units;
use View;


class UnitController extends Controller
{

    private $helpers = null;

    private $up;

    private $tp;

    private $types;

    public function __construct(\Btybug\Modules\Models\Plugins\Gears\Models\UnitUpload $unitUpload, validateUpl $validateUpl)
    {
        $this->upload = new $unitUpload;
        $this->validateUpl = new $validateUpl;
        $this->up = config('paths.ui_elements_uplaod');
        $this->tp = config('paths.units_path');
        $this->types = @json_decode(File::get(config('paths.unit_path') . 'configTypes.json'), 1)['types'];
    }

    public function getIndex()
    {
        $types = $this->types;
        $type = "backend";
        $ui_units = Units::getAllUnits()->where('section', $type)->run();

        return view('resources::units.list', compact(['ui_units', 'type', 'types']));
    }

    public function getFrontend()
    {
        $types = $this->types;
        $type = 'frontend';
        $ui_units = Units::getAllUnits()->where('section', $type)->run();

        return view('resources::units.list', compact(['ui_units', 'type', 'types']));
    }

    public function getUnit($type)
    {
        $ui_units = Units::getAllUnits()->run();

        return view('resources::units', compact(['$ui_units']));
    }

    public function getUnitVariations($slug)
    {
        $unit = Units::find($slug);
        if (!count($unit)) return redirect()->back();
        $variation = [];
        $variations = $unit->variations();

        return view('resources::units.variations', compact(['unit', 'variations', 'variation'])
        );
    }


    public function postUnitWithType(Request $request)
    {
        $main_type = $request->get('main_type');
        $general_type = $request->get('type', null);

        if ($general_type) {
            $ui_units = Units::getAllUnits()->where('main_type', $main_type)->where('type', $general_type)->run();
        } else {
            $ui_units = Units::getAllUnits()->where('type', $main_type)->run();
        }

        $html = View::make('resources::units._partials.list_cube', compact(['ui_units']))->render();

        return \Response::json(['html' => $html, 'error' => false]);
    }

    public function postUnitVariations(Request $request, $slug)
    {
        $ui = Units::find($slug);
        if (!$ui) return redirect()->back();
        $ui->makeVariation($request->except('_token', 'ui_slug'))->save();

        return redirect()->back();
    }

    public function postUploadUnit(Request $request)
    {
        $data = ($request->all());
        if ($data['data_type'] == 'files') return $this->file_upload->upload($request);
        $isValid = $this->validateUpl->isCompress($request->file('file'));

        if (!$isValid) return $this->upload->ResponseError('Uploaded data is InValid!!!', 500);

        $response = $this->upload->upload($request);
        if (!$response['error']) {
            $result = $this->upload->validatConfAndMoveToMain($response['folder'], $response['data']);
            if (!$result['error']) {
                File::deleteDirectory($this->up, true);
                $this->upload->makeVariations($result['data']);

                return $result;
            } else {
                File::deleteDirectory($this->up, true);

                return $result;
            }
        } else {
            File::deleteDirectory($this->up, true);

            return $response;
        }

    }

    public function getDeleteUnit($id)
    {
        $variation = Units::deleteVariation($id);

        return redirect()->back();
    }

    public function postDelete(Request $request)
    {
        $slug = $request->get('slug');
        $tpl = Units::find($slug)->delete();

        return \Response::json(['message' => 'Please try again', 'error' => !$tpl]);
    }

    public function getSettings($id)
    {
        $slug = explode('.', $id);
        $ui = Units::find($slug[0]);
        $variation = Units::findVariation($id);
        if (!$variation) return redirect()->back();
        $settings = (isset($variation->settings) && $variation->settings) ? $variation->settings : [];

        return view('resources::settings', compact(['ui', 'variation', 'id', 'settings']));
    }

    public function unitPreview($id)
    {
        $slug = explode('.', $id);
        $ui = Units::find($slug[0]);
        $variation = Units::findVariation($id);

        if (!$variation) return redirect()->back();

        $ifrem = [];
        $settings = (isset($variation->settings) && $variation->settings) ? $variation->settings : [];

        $ifrem['body'] = url('/admin/resources/units/settings-iframe', $id);
        $ifrem['settings'] = url('/admin/resources/units/settings-iframe', $id) . '/settings';

        return view('resources::preview', compact(['ui', 'id', 'ifrem', 'settings']));

    }

    public function unitPerviewIframe($id, $type = null)
    {
        $slug = explode('.', $id);
        $ui = Units::find($slug[0]);
        $variation = Units::findVariation($id);
        if (!$variation) return redirect()->back();
        $settings = (isset($variation->settings) && $variation->settings) ? $variation->settings : [];
        $extra_data = 'some string';
        if ($ui->main_type == 'data_source') {
            $extra_data = BBGiveMe('array', 3);
        }
        $htmlBody = $ui->render(['settings' => $settings, 'source' => $extra_data, 'cheked' => 1, 'field' => null]);
        $htmlSettings = $ui->renderSettings(compact('settings'));
        $settings_json = json_encode($settings, true);

        return view('resources::units._partials.unit_preview', compact(['htmlBody', 'htmlSettings', 'settings', 'settings_json', 'id', 'ui']));
    }

    public function postSettings(Request $request, $id, $save = false)
    {
        $data = $request->except(['_token']);
        $variation = Units::findVariation($id);

        if (!empty($data) && $variation) {

            $variation->setAttributes('settings', $data);
            if ($save) {
                $variation->save();
            }
        }
        $settings = (isset($variation->settings) && $variation->settings) ? $variation->settings : [];
        $slug = explode('.', $id);
        $ui = Units::find($slug[0]);
        $html = $ui->render(['settings' => $settings, 'source' => BBGiveMe('array', 5), 'cheked' => 1]);

        return \Response::json(['html' => $html, 'error' => false]);
    }

    public function getDefaultVariation($id)
    {
        $data = explode('.', $id);
        $unit = Units::find($data[0]);

        if (!empty($data) && $unit) {
            foreach ($unit->variations() as $variation) {
                $variation->setAttributes('default', 0);
                $variation->save();
            }

            $variation = Units::findVariation($id);
            $variation->setAttributes('default', 1);
            $variation->save();

            return redirect()->back()->with('message', 'New Default variation is ' . $variation->title);
        }

        return redirect()->back();
    }

    public function getMakeDefault($slug)
    {
        $units = Units::getAllUnits()->where('type', 'fields')->run();
        if (count($units)) {
            foreach ($units as $unit) {
                if ($unit->slug == $slug) {
                    $default = $unit->title;
                    $unit->setAttributes('default', 1);
                } else {
                    $unit->setAttributes('default', 0);
                }
                $unit->save();
            }
            return redirect()->back()->with('message', 'New Default Unit is ' . $default);
        }

        return redirect()->back();
    }
}

