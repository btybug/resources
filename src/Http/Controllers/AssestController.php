<?php

namespace Btybug\Resources\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Resources\Models\Assest;
use App\Modules\Resources\Models\Manage;
use App\Modules\Resources\Models\StyleItems;
use App\Repositories\TermRepository as Terms;
use File;
use Illuminate\Http\Request;
use Sahakavatar\Cms\Helpers\helpers;
use Session;
use Zipper;

class AssestController extends Controller
{

    // private $page;
    private $assest;
    private $helpers = null;
    private $destinationPath = null;
    private $terms = null;
    private $manager = '';

    private $libs;


    public function __construct(Terms $terms, Manage $manager)
    {
        $this->helpers = new helpers;
        $this->destinationPath = 'public/plugins';
        $this->terms = $terms;
        $this->manager = $manager;
        $this->libs = config('paths.libs');

    }

    public function getIndex()
    {
        $assets = [];
        $files = File::directories('resources/assets/js');

        foreach ($files as $file) {
            $str = (string)$file;
            $this->addAssestToDB(class_basename($str), 'js');
        }
        $assets = Assest::get();

        return view('resources::assests.index', compact(['assets']));
    }

    /**
     * @param $plugin_name
     * @param $section
     * @return mixed
     */
    private function addAssestToDB($plugin_name, $section)
    {
        $assest = Assest::where('folder', $plugin_name)->where('section', $section)->first();
        if (!$assest) {
            $assest = new Assest;
            $assest->title = camel_case($plugin_name);
            $assest->folder = $plugin_name;
            $assest->section = $section;
            $assest->save();
        }

        return $assest->id;
    }

    public function getAssets($section)
    {
        $assets = [];

        if ($section == 'libs' || $section == 'editor') {
            $files = File::directories('public/' . $section);
        } else {
            $files = File::files('public/' . $section);
        }


        foreach ($files as $file) {
            $str = (string)$file;
            $this->addAssestToDB(class_basename($str), $section);
        }

        $assets = Assest::where('section', $section)->where('theme_id', '0')->get();

        return view('resources::assests._ajaxindex', compact(['assets', 'section']));
    }

    public function getCreate()
    {
        $tot_snippts = 0;

        return view('resources::assests.create', compact(['tot_snippts']));
    }

    public function postUpload(Request $request)
    {
        $response = $this->manager->upload($request);
        if ($response['code'] == '200') {
            $this->saveAssest($response['file'], $response['section']);
        }

        $response = response()->json(
            [
                $response
            ]
        );

        return $response;
    }

    private function saveAssest($plugin_name, $section)
    {
        $id = $this->addAssestToDB($plugin_name, $section);
        Session::flash('message', 'Upload Successfully!');
        Session::flash('alert-class', 'alert-success');

        return $id;
    }

    public function postOverwrite(Request $request)
    {
        $req = $request->all();
        $name = $req['name'];
        $section = $req['val'];
        if (File::isDirectory(config('paths.tmp_upload') . $name)) {
            File::copyDirectory(config('paths.tmp_upload') . $name, config('paths.' . $section) . "/" . $name);
            $this->helpers->safeDeleteFolder(
                [config('paths.tmp_upload') . $name, config('paths.tmp_upload') . $name . '.zip']
            );
        } else {

            File::copy(config('paths.tmp_upload') . $name, config('paths.' . $section) . "/" . $name);
            File::delete(config('paths.tmp_upload') . $name);
        }

        $this->saveAssest($name, $section);
    }

    public function postDiscard(Request $request)
    {
        $req = $request->all();
        $name = $req['name'];
        if (File::isDirectory(config('paths.tmp_upload') . $name)) {
            $this->helpers->safeDeleteFolder(
                [config('paths.tmp_upload') . $name, config('paths.tmp_upload') . $name . '.zip']
            );
        } else {
            File::delete(config('paths.tmp_upload') . $name);
        }
    }

    public function getUpdate($id)
    {
        $asset = Assest::find($id);
        $snippts = ($asset->snippets != '') ? unserialize($asset->snippets) : '';
        $tot_snippts = (is_array($snippts)) ? count($snippts) : 0;

        return view('resources::assests.edit', compact(['asset', 'snippts', 'tot_snippts']));
    }

    public function postUpdate(Request $request)
    {
        $req = $request->all();
        $asset = Assest::find($req['id']);
        $asset->title = $req['title'];
        $asset->site_link = $req['site_link'];
        $asset->description = $req['description'];
        $asset->snippets = (isset($req['snippt'])) ? serialize($req['snippt']) : '';
        $asset->save();
        $this->helpers->updatesession('Asset Updated Successfully!', 'alert-success');

        return redirect('/admin/resources/core_assest');
    }

    public function getDelete($id)
    {
        $asset = Assest::find($id);
        $sec = $asset->section;

        if ($asset->section != 'libs' && $asset->section != 'editor') {
            $path = $this->$sec . '/' . $asset->folder;
            if (File::exists($path)) {
                File::delete($path);
            }
        } else {
            $path = $this->$sec . '/' . $asset->folder;
            if (File::isDirectory($path)) {
                $this->helpers->safeDeleteFolder([$path]);
            }
        }
        $asset->delete();

        return redirect('/admin/resources/core_assest');
    }

    public function postCreate(Request $request)
    {
        $req = $request->all();
        $assest = new Assest;
        $assest->title = $req['title'];
        $assest->site_link = $req['site_link'];
        $assest->description = $req['description'];
        $assest->save();

        return redirect('/admin/resources/core_assest');
    }


    // Fonts
    public function getFontsList()
    {

        cors();

        $assets = [];

        $fonts = File::directories('public/fonts');
        foreach ($fonts as $font) {
            if (file_exists($font . '/config.json')) {
                $config = json_decode(file_get_contents($font . '/config.json'));
                $assets[] = [
                    'title' => $config->title,
                    'folder' => basename($font)
                ];
            }
        }

        return $assets;
    }

    public function getFontIcons($folder)
    {

        cors();

        $list = $config = [];

        $folder = 'public/fonts/' . $folder;
        if (file_exists($folder . '/config.json')) {
            $config = json_decode(file_get_contents($folder . '/config.json'));
            $list = json_decode(file_get_contents($folder . '/list.json'), true);
        }

        return ['config' => $config, 'list' => $list];
    }

    public function getFonts()
    {
        $fonts = File::directories('resources/assets/fonts');
        $editors = [];//File::directories('resources/assets/js/');
        $data = array_merge($fonts, $editors);

        foreach ($data as $item) {
            if (file_exists($item . '/config.json')) {
                $config = json_decode(file_get_contents($item . '/config.json'));
                $assets[] = [
                    'title' => $config->title,
                    'folder' => basename($item)
                ];
            }
        }


        return view('resources::assests.fonts', compact(['assets']));
    }

    public function getFontPreview($folder)
    {
        $folder = 'public/fonts/' . $folder;
        if (file_exists($folder . '/config.json')) {
            $config = json_decode(file_get_contents($folder . '/config.json'));
            $list = json_decode(file_get_contents($folder . '/list.json'), true);
            $css_link = $folder . '/' . $config->css . '.css';
        }

        return view('resources::assests.font_preview', compact(['config', 'list', 'css_link']));
    }

    public function getDeleteFont($font_folder)
    {
        $folder = 'public/fonts/' . $font_folder;
        if (file_exists($folder . '/config.json')) {
            File::deleteDirectory($folder);
        }

        return redirect('/admin/resources/core_assest/fonts');
    }

    public function postUploadfont(Request $request)
    {

        $extension = $request->file('file')->getClientOriginalExtension();
        if ($extension != 'zip') {
            Session::flash('message', 'Invalid File Type!');
            Session::flash('alert-class', 'alert-danger');
        } else {
            $path = 'public/fonts/';

            $zip_file = $request->file('file')->getClientOriginalName();
            $request->file('file')->move($path, $zip_file);

            Zipper::make('public/fonts/' . $zip_file)->extractTo('public/fonts');
            File::delete('public/fonts/' . $zip_file);
        }

        return "success";
    }


}
