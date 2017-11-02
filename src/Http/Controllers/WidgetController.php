<?php

namespace Btybug\Resources\Http\Controllers;

use App\Modules\Resources\Models\Styles;
use App\Modules\Resources\Models\TemplateVariations as TemplateVariations;
use App\Modules\Resources\Models\UiUpload;
use App\Modules\Resources\Models\Validation as validateUpl;
use App\Modules\Users\Models\Roles;
use App\Modules\Users\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Resources;
use Sahakavatar\Cms\Models\Widgets;
use Session;
use View;
use Zipper;

/**
 * Class CloudController
 * @package App\Modules\Cloud\Http\Controllers
 */
class WidgetController extends Controller
{

    /**
     * @var bundlehelper
     */
    protected $phelper;
    /**
     * @var
     */
    private $upload;
    /**
     * @var
     */
    private $validateUpl;

    /**
     * @var string
     */
    private $path = 'appdata/theme/';

    /**
     * @var mixed
     */
    private $up;
    /**
     * @var
     */
    private $tp;

    /**
     * CloudController constructor.
     * @param bundlehelper $phelper
     * @param UiUpload $uiUpload
     * @param validateUpl $validateUpl
     */
    public function __construct(UiUpload $uiUpload, validateUpl $validateUpl)
    {
        $this->upload = new $uiUpload;
        $this->validateUpl = new $validateUpl;

        $this->up = config('paths.ui_elements_uplaod');
        $this->uep = config('paths.ui_elements_path');
    }

    /**
     * @return View
     */
    public function getIndex()
    {
        $type = 'backend';
        $ui_elemements = Widgets::getAllWidgets()->where('main_type', 'panels')->where('type', $type)->run();
        return view('resources::widgets.list', compact(['ui_elemements', 'type',]));
    }

    public function getFrontend()
    {
        $type = 'frontend';
        $ui_elemements = Widgets::getAllWidgets()->where('main_type', 'panels')->where('type', $type)->run();
        return view('resources::widgets.list', compact(['ui_elemements', 'type']));
    }


    /**
     * @param $type
     * @return View
     */
    public function getUi($type)
    {
        $ui_elemements = Widgets::getAllWidgets()->where('main_type', 'panels')->run();
        return view('resources::ui', compact(['ui_elemements']));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUiWithType(Request $request)
    {
        $main_type = $request->get('main_type');
        $general_type = $request->get('type', null);
        $url = $request->get('url');
//        dd($main_type,$general_type);
        if ($general_type) {
            $ui_elemements = Widgets::getAllWidgets()->where('main_type', $general_type)->where('type', $main_type)->run();
        } else {
            $ui_elemements = Widgets::getAllWidgets()->where('main_type', $main_type)->run();
        }

        $html = View::make('resources::widgets._partials.list_cube', compact(['ui_elemements', 'url']))->render();

        return \Response::json(['html' => $html, 'error' => false]);
    }

    public function getDeleteVariation($id)
    {
        $variation = Widgets::deleteVariation($id);

        return redirect()->back();
    }

    public function postDelete(Request $request)
    {
        $slug = $request->get('slug');
        $tpl = Widgets::find($slug)->delete();
        return \Response::json(['message' => 'Please try again', 'error' => !$tpl]);
    }

    public function getUiVariations($slug)
    {
        $ui = Widgets::find($slug);
        if (!$ui) return redirect()->back();
        $variation = [];
        $variations = $ui->variations();

        return view(
            'resources::variations',
            compact(['ui', 'variations', 'title', 'sections', 'variation', 'taxonomies'])
        );
    }

    public function postUiVariations(Request $request, $slug)
    {
        $ui = Widgets::find($slug);
        if (!$ui) return redirect()->back();
        $ui->makeVariation($request->except('_token', 'ui_slug'))->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postUploadUi(Request $request)
    {
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

    public function postGetVariations(Request $request)
    {
        $id = $request->get('id');
        $variation = Widgets::findVariation($id);
        $slug = explode('.', $id);
//        $sections = Sections::lists('blog_slug','id')->all();
        $html = View::make('resources::Widgets.edit_variation', compact(['variation', 'slug', 'sections']))->render();

        return \Response::json(['html' => $html]);
    }

    public function postEditVariation(Request $request)
    {
        $variation = Widgets::findVariation($request->get('id'));
        $variation->title = $request->get('title');
        $variation->section_id = $request->get('section_id');
        if (!isset($variation->section_id)) {
            $variation->setAttributes('section_id', $request->get('section_id'));
        }

        $variation->save();
        return redirect()->back();
    }

    public function getSettings($id)
    {
        $slug = explode('.', $id);
        $ui = Widgets::find($slug[0]);
        $variation = Widgets::findVariation($id);
        if (!$variation) return redirect()->back();

        $settings = (isset($variation->settings) && $variation->settings) ? $variation->settings : [];

        return view(
            'resources::settings',
            compact(['ui', 'variation', 'id', 'settings'])
        );
    }

    public function widgetPerview($id)
    {
        $slug = explode('.', $id);
        $ui = Widgets::find($slug[0]);
        $variation = Widgets::findVariation($id);
        if (!$variation) return redirect()->back();
        $ifrem = array();
        $settings = (isset($variation->settings) && $variation->settings) ? $variation->settings : [];
        $ifrem['body'] = url('/admin/resources/widgets/settings-iframe', $id);
        $ifrem['settings'] = url('/admin/resources/widgets/settings-iframe', $id) . '/settings';
        return view('resources::preview', compact(['ui', 'id', 'ifrem', 'settings']));
    }

    public function widgetPerviewIframe($id, $type = null)
    {
        $slug = explode('.', $id);
        $ui = Widgets::find($slug[0]);
        $variation = Widgets::findVariation($id);
        if (!$variation) return redirect()->back();
        $settings = (isset($variation->settings) && $variation->settings) ? $variation->settings : [];
        $htmlBody = $ui->render(['settings' => $settings]);
        $htmlSettings = $ui->renderMainSettings(compact('settings'));
        $settings_json = json_encode($settings, true);
        return view('resources::assests.wifpreview', compact(['htmlBody', 'htmlSettings', 'settings', 'settings_json', 'id', 'ui']));
    }


    public function postSettings(Request $request, $id, $save = false)
    {
        $data = $request->except(['_token']);
        $variation = Widgets::findVariation($id);

        if (!empty($data) && $variation) {

            $variation->setAttributes('settings', $data);
            if ($save) {
                $variation->save();
            }
        }
        $settings = (isset($variation->settings) && $variation->settings) ? $variation->settings : [];
        $slug = explode('.', $id);
        $ui = Widgets::find($slug[0]);
        $html = $ui->render(['settings' => $settings]);
        return \Response::json(['html' => $html, 'error' => false]);
    }

    //old UI action

    /**
     * @param $type
     * @return View
     */
    public function getUiOldAction($type)
    {
        $components_list = $this->componentsList($type);
        return view('resources::ui', compact(['components_list', 'type']));
    }



    // Preview UI Component

    /**
     * @param $type
     * @return array
     */
    private function componentsList($type)
    {
        $frontend = array(
            'widget'
        );

        $backend = array(
            'admin_widget'
        );

        $components = $frontend;
        if ($type == 'admin') {
            $components = $backend;
        }

        return $components;
    }

    // Component Customiser

    /**
     * @param $ui_type
     * @param $type
     * @param $component_name
     * @return View
     */
    public function getPreview($ui_type, $type, $component_name)
    {

        $resources = [
            'header' => [
                'adminjs' => [
                    'bootstrap',
                    'jquery-ui',
                    URL("public/js/admin.js")
                ],
                'adminstyle' => [
                    'bootstrap',
                    asset("public/libs/jqueryui/css/jquery-ui.min.css"),
                ]
            ]
        ];

        $component_dir = $this->path . 'store/' . $ui_type . '/' . $type . '/' . $component_name;
        $page_content = '';

        if (is_dir($component_dir)) {
            $page_content = file_get_contents($component_dir . "/ui.html");
        }

        $component = json_decode(file_get_contents($component_dir . '/config.json'));
        if ($component->preview_wrapper) {
            $page_content = str_replace("|", $page_content, $component->preview_wrapper);
        }

        if (is_file($component_dir . '/style.css')) {
            $resources['header']['adminstyle'][] = URL($component_dir . '/style-123.css');
        }

        if (isset($component->dependencies)) {
            $dependencies = $component->dependencies;
            if (isset($dependencies->css) and count($dependencies->css) > 0) {
                foreach ($dependencies->css as $css) {
                    $resources['header']['adminstyle'][] = $css;
                }
            }

            if (isset($dependencies->js) and count($dependencies->js) > 0) {
                foreach ($dependencies->js as $js) {
                    $resources['header']['adminjs'][] = $js;
                }
            }
        }

        // Register Resources
        Resources::registerCollection('header', $resources['header']);

        return view('resources::preview', compact(['page_content']));
    }

    /**
     * @param $ui_type
     * @param $type
     * @param $component_name
     * @return View
     */
    public function getCustomiser($ui_type, $type, $component_name)
    {
        $component_dir = $this->path . 'store/' . $ui_type . '/' . $type . '/' . $component_name;
        $component = json_decode(file_get_contents($component_dir . '/config.json'), true);
        $customiser = $component['customiser'];
        $preview = URL('admin/resources/ui/preview/' . $ui_type . '/' . $type . '/' . $component_name);

        return view('resources::customiser', compact(['customiser', 'component', 'preview']));
    }

    // Admin theme settings

    /**
     * @param $id
     * @return array
     */
    public function getClassVariations($id)
    {
        return BBGetClassVariations($id);
    }

    // Save admin theme settings

    /**
     * @param null $role
     * @return View
     */
    public function getAdminThemeSettings($role = null)
    {
        // Settings for role
        if ($role) {

            $admin_profile = \App\Modules\Cloud\AdminProfiles::where('role', $role)->first();

            $themeSettings = '{}';
            $optionals = [
                "widget" => '',
                "menu-1" => '',
                "menu-2" => ''
            ];

            if ($admin_profile->json_settings) {
                $themeSettings = $admin_profile->json_settings;
                $themeSettingsArray = json_decode($admin_profile->json_settings, true);

                $checked = ' checked="checked"';
                if (isset($themeSettingsArray['active-menu-1'])) $optionals['menu-1'] = $checked;
                if (isset($themeSettingsArray['active-menu-2'])) $optionals['menu-2'] = $checked;
                if (isset($themeSettingsArray['active-widget'])) $optionals['widget'] = $checked;
            }

            return view('cloud::admin_theme_settings', compact(['themeSettings', 'optionals', 'role']));
        }

        $roles = Roles::where('id', '!=', User::ROLE_USER)->get();
        // Profiles Listing
        return view('cloud::admin_theme_profiles', compact(['roles']));
    }

    /**
     * @return array
     */
    public function postSaveSettings()
    {
        $settings = json_decode($_POST['settings']);
        $admin_profile = \App\Modules\Cloud\AdminProfiles::where('role', $settings->role)->first();
        $admin_profile->json_settings = $_POST['settings'];

        $styles = '';

        foreach ($settings as $k => $v) {
            if (strpos($k, '_parent') === false and strpos($k, '-menu-') === false) {
                if (intval($v) > 0) {
                    $variation = "[data-select='$k']" . '{' . BBGetClassVariation($v, 'css') . '}';
                    $styles .= $variation;
                }
            }
        }

        $admin_profile->theme_css = $styles;
        $admin_profile->save();

        // Concat styles in backend.css
        generateBackendCss($settings->role);

        return [
            "msg" => "success",
            "styles" => $styles
        ];
    }

    // Read directory files

    /**
     * @param $type
     * @param Request $request
     */
    public function postUpload($type, Request $request)
    {
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');
        ini_set('max_input_time', 30000);
        ini_set('max_execution_time', 30000);

        if ($request->hasFile('file')) {

            $destinationPath = templatesPath();
            if ($type == 'admin') {
                $destinationPath = templatesPath(null, true);
            }
            // upload path
            $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
            if ($extension != 'zip') {
                Session::flash('message', 'Invalid File Type!');
                Session::flash('alert-class', 'alert-danger');
            } else {
                $name = $request->file('file')->getClientOriginalName();
                $tpl_name = str_replace(".zip", "", $name);
                File::deleteDirectory($destinationPath . "/" . $tpl_name);
                $request->file('file')->move($destinationPath, $name); // uploading file to given path
                File::makeDirectory($destinationPath . "/" . $tpl_name, 0755, true);
                Zipper::make($destinationPath . "/" . $name)->extractTo($destinationPath . "/" . $tpl_name);

                if (!File::exists($destinationPath . "/" . $tpl_name . "/conf.json")) {
                    File::copyDirectory(
                        $destinationPath . "/" . $tpl_name . "/" . $tpl_name,
                        $destinationPath . "/" . $tpl_name
                    );
                    File::deleteDirectory($destinationPath . "/" . $tpl_name . "/" . $tpl_name);
                }
                $conf_arr = file_get_contents($destinationPath . "/" . $tpl_name . "/conf.json");
                $conf_arr = json_decode($conf_arr, true);

                File::delete($destinationPath . "/" . $tpl_name . "/conf.json");

                $obj = Template::where('slug', $conf_arr['slug'])->first();
                if (!$obj) {
                    $obj = new Template;
                }
                $obj->title = $conf_arr['title'];
                $obj->folder_name = $tpl_name;

                $obj->description = $conf_arr['description'];
                $obj->slug = $conf_arr['slug'];
                $obj->have_setting = $conf_arr['have_setting'];

                $obj->type = $conf_arr['type'];
                $obj->version = $conf_arr['version'];
                $obj->author = $conf_arr['author'];
                $obj->site = $conf_arr['site'];

                $obj->save();

                $variation = new TemplateVariations;
                $variation->template_id = $obj->id;
                if (isset($obj->title)) {
                    $variation->variation_name = $obj->title . " Default Variation";
                }
                $variation->save();

                if (isset($conf_arr['required_widgets']) && $conf_arr['required_widgets'] == 1) {
                    $this->phelper->registerWidgets($destinationPath . "/" . $tpl_name, $obj->folder_name, $obj->id);
                }

                if (isset($conf_arr['required_forms']) && $conf_arr['required_forms'] == 1) {
                    $this->phelper->registerForms($destinationPath . "/" . $tpl_name, $obj->folder_name);
                }


                if (isset($conf_arr['require_menu']) && $conf_arr['require_menu'] == 1) {
                    $this->phelper->registerMenu($destinationPath . "/" . $tpl_name, $obj->folder_name);
                }


                File::delete($destinationPath . "/" . $name);
            }
        } else {
            $this->helpers->updatesession('Upload Not Successfull!', 'alert-danger');
        }
    }

    public function postAjaxbb(Request $request)
    {
        $fun = $request->input('fun');
        $params = $request->input('vals');
        $params = explode(",", $params);
        return call_user_func_array($fun, $params);
    }

    public function getDefaultVariation($id)
    {
        $data = explode('.', $id);
        $widget = Widgets::find($data[0]);

        if (!empty($data) && $widget) {
            foreach ($widget->variations() as $variation) {
                $variation->setAttributes('default', 0);
                $variation->save();
            }

            $variation = Widgets::findVariation($id);
            $variation->setAttributes('default', 1);
            $variation->save();

            return redirect()->back()->with('message', 'New Default variation is ' . $variation->title);
        }

        return redirect()->back();
    }

    public function getMakeDefault($slug)
    {
        $widgets = Widgets::getAllWidgets()->where('main_type', 'fields')->run();
        if ($widgets) {
            foreach ($widgets as $widget) {
                if ($widget->slug == $slug) {
                    $default = $widget->title;
                    $widget->setAttributes('default', 1);
                } else {
                    $widget->setAttributes('default', 0);
                }
                $widget->save();
            }

            return redirect()->back()->with('message', 'New Default Widget is ' . $default);
        }

        return redirect()->back();
    }

    /**
     * @param $dir
     * @return array
     */
    private function readDirectory($dir)
    {
        $result = array();
        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                $result[] = $value;
            }
        }
        return $result;
    }
}
