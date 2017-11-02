<?php

namespace Btybug\Resources\Models\Files;

use File;
use Sahakavatar\Cms\Models\Templates\Units;

/**
 * Created by PhpStorm.
 * User: Comp1
 * Date: 11/24/2016
 * Time: 4:58 PM
 */
class FileUpload
{
    protected $dir;
    protected $json;
    protected $uf;

    public function __construct()
    {
        $this->dir = config('paths.files_path');
        $this->json = config('paths.files_path') . 'files.json';
        $this->uf = base_path(config('paths.ui_elements_uplaod'));

    }

    public function upload($request)
    {
        $rules = ['file' => 'required|file',
            'extension' => 'required|in:csv,xls,xlsx,json,xml|max:2048',
        ];
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data = [
                'file' => $file,
                'extension' => strtolower($file->getClientOriginalExtension()),
            ];
            $v = \Validator::make($data, $rules);
            if (!$v->fails()) {
                $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
                $name = $request->file('file')->getClientOriginalName();
                $id = uniqid();
                if ($extension == 'csv' or $extension == 'xls' or $extension == 'xlsx') {
                    $request->file('file')->move($this->uf, $id . '.' . $extension); // uploading file to given path
                    $json_data = json_encode(\Excel::load($this->uf . $id . '.' . $extension)->all(), true);
                    File::put($this->dir . $extension . '/' . $id . '.json', $json_data);
                    File::delete($this->uf . $id . '.' . $extension);
                    $json = json_decode(File::get($this->json), true);
                }

                $json[$id] = [
                    "id" => $id,
                    "title" => $name,
                    "type" => "files",
                    "main_type" => $extension,
                    "ext" => $extension,
                    "file_path" => $this->dir . $extension . '/' . $id . '.' . $extension,
                    "image" => Units::images($extension),
                    "upload_at" => time()
                ];
                File::put($this->json, json_encode($json, true));

                return ['code' => 200, 'error' => false];
            }
            return ['code' => 400, 'error' => true, 'messages' => $v->messages()];
        }
        return ['code' => 400, 'error' => true, 'messages' => ['no file']];
    }
}