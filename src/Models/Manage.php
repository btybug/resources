<?php

namespace Btybug\Resources\Models;

use File;
use Illuminate\Http\Request;
use Zipper;

class Manage
{

    public $helper;
    private $sf = NULL; // sample Folders Path
    private $tf = NULL; // TEMP Upload Folders Path
    private $js;
    private $css;
    private $image;
    private $libs;
    private $fonts;
    private $editor;
    private $jquery_main;
    private $css_main;

    /**
     * Manage constructor.
     */
    public function __construct()
    {
        $this->helpers = new helpers;
        $this->dhelper = new dbhelper();
        $this->sf = config('paths.samples') . "themes/THEME";
        $this->tf = config('paths.tmp_upload');

        $this->js = config('paths.js');
        $this->css = config('paths.css');
        $this->image = config('paths.images');
        $this->libs = config('paths.libs');
        $this->fonts = config('paths.fonts');
        $this->editor = config('paths.editor');
        $this->jquery_main = config('paths.jquery_main');
        $this->css_main = config('paths.css_main');
    }

    public function buildTheme($data, $parent)
    {
        $slug = str_slug($data['name'], "-");
        if ($data['parent_id'] != '') {
            $data['parent'] = $parent->slug;
        } else {
            $data['slug'] = str_slug($data['name'], "-");
        }
        File::copyDirectory($this->sf, $this->tf . $slug);
        File::put($this->tf . $slug . "/theme.json", json_encode($data));

        $files = glob($this->tf . $slug);
        $zip = Zipper::make($this->tf . $slug . '.zip')->add($files);
        $zip->close();

        File::deleteDirectory($this->tf . $slug);
        return $slug;
    }

    public function upload(Request $request)
    {
        $req = $request->all();
        $section = $req['group_id'];
        $path = $this->$section;
        $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
        $full_name = $request->file('file')->getClientOriginalName();
        $name = str_replace("." . $extension, "", $full_name);
        $request->file('file')->move($this->tf, $full_name);

        if ($extension == 'zip') {
            $response = $this->extractZip($full_name, $name, $path);
        } else {
            if (File::exists($path . "/" . $full_name)) {
                $response = [
                    'code' => 401,
                    'file' => $full_name,
                    'path' => $path
                ];
            } else {
                File::copy($this->tf . $full_name, $path . "/" . $full_name);
                $response = [
                    'code' => 200,
                    'file' => $full_name,
                    'section' => $section
                ];
            }
        }


        return $response;
    }

    public function extractZip($full_name, $name, $path)
    {

        Zipper::make($this->tf . $full_name)->extractTo($this->tf . $name);
        if (File::exists($this->tf . $name . "/" . $name)) {
            File::copyDirectory($this->tf . $name . "/" . $name, $this->tf . "/" . $name);
            $this->helpers->safeDeleteFolder([$this->tf . $name . "/" . $name]);
        }

        if (File::exists($path . "/" . $name)) {
            $response = [
                'code' => 401,
                'file' => $name,
                'path' => $path
            ];
        } else {
            File::copyDirectory($this->tf . $name, $path . "/" . $name);
            $response = [
                'code' => 200,
                'file' => $name,
                'section' => class_basename($path)
            ];
        }

        return $response;
    }

    public function getStatus()
    {
        return ['draft' => 'Draft', 'pending' => 'Pending Review', 'published' => 'Published'];
    }

    public function getVisible()
    {
        return ['yes' => 'Yes', 'no' => 'NO'];
    }

    /**
     * @return array
     */
    public function assestCols()
    {
        $form_fields = [
            'id' => 'ID',
            'title' => 'Title',
            'site_link' => 'Site Link',
            'created_at' => 'Created Date',
            'action' => 'Action'
        ];
        $columns = $this->dhelper->getColumnsJson($form_fields);
        return ['form_fields' => $form_fields, 'columns' => $columns];
    }

}
