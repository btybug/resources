<?php

namespace Btybug\Resources\Models\Files\traits;
/**
 * Created by PhpStorm.
 * User: shojan
 * Date: 11/24/2016
 * Time: 12:01 PM
 */
trait FilesPreview
{
    protected $json;

    public static function getAllFiles($main_type = null)
    {
        $_self = new static();
        $_self->json = config('paths.files_path') . 'files.json';
        $types = json_decode(\File::get($_self->json), true);
        $all = array();
        $array = array();
        foreach ($types as $type) {
            $fobject = new static();
            $array['id'] = $type['id'];
            $array['title'] = $type['title'];
            $array['main_type'] = $type['main_type'];
            $array['type'] = $type['type'];
            $array['enabled'] = true;
            $array['file_path'] = str_replace("." . $type['ext'], '.json', $type['file_path']);
            $array['image'] = $type['image'];
            $fobject->attributes = $array;
            $all[] = $fobject;
        }
        return collect($all);

    }

    public static function getFilesTypes($main_type)
    {
        $_self = new static();
        $_self->json = config('paths.files_path') . 'files.json';
        $all = array();
        $array = array();
        $files = json_decode(\File::get($_self->json), true);
        foreach ($files as $file) {
            if ($file['main_type'] == $main_type) {
                $fobject = new static();
                $array['id'] = $file['id'];
                $array['title'] = $file['title'];
                $array['main_type'] = $file['main_type'];
                $array['type'] = $file['type'];
                $array['enabled'] = true;
                $array['file_path'] = str_replace("." . $file['ext'], '.json', $file['file_path']);
                $array['image'] = $file['image'];
                $fobject->attributes = $array;
                $all[] = $fobject;
            }
        }
        return collect($all);

    }

    public static function images($ext)
    {
        //csv,xls,xlsx,json
        $images = [
            'csv' => "resources/assets/images/files/csv.png",
            'xls' => "resources/assets/images/files/xls.png",
            'xlsx' => "resources/assets/images/files/xlsx.jpg",
            'json' => "resources/assets/images/files/json.png",
            'xml' => "resources/assets/images/files/xml.png",
        ];
        return $images[$ext];
    }

    public static function findFile($id)
    {
        $_self = new static();
        $_self->json = config('paths.files_path') . 'files.json';
        $files = json_decode(\File::get($_self->json), true);
        if (!isset($files[$id])) return null;
        $file = $files[$id];
        $fobject = new static();
        $array['id'] = $file['id'];
        $array['title'] = $file['title'];
        $array['main_type'] = $file['main_type'];
        $array['type'] = $file['type'];
        $array['enabled'] = true;
        $array['file_path'] = str_replace("." . $file['ext'], '.json', $file['file_path']);
        $array['image'] = $file['image'];
        $fobject->attributes = $array;
        return $fobject;
    }

    public function getColumns()
    {
        $columns = [];
        $data = json_decode(\File::get($this->file_path));
        if (count($data)) {
            $item = array_first($data);
            foreach ($item as $k => $v) {
                $columns[$k] = $k;
            }
        }
        return $columns;
    }

    public function getColumnsListing($data)
    {
        $columns = [];
        $file_data = json_decode(\File::get($this->file_path));
        if (count($file_data)) {
            foreach ($file_data as $item) {
                foreach ($item as $k => $v) {
                    if ($k == $data['key']) {
                        $key = $v;
                    }
                    if ($k == $data['value']) {
                        $value = $v;
                    }

                    if (isset($key) && isset($value)) {
                        $columns[$key] = $value;
                    }
                }
            }
        }

        return $columns;
    }
}