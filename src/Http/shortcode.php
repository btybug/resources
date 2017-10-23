<?php

use App\Modules\Resources\Assest;
use App\Modules\Resources\Models\Classes;


if (!function_exists('BBClasses')) {

    /**
     * Provide a collection of classes of specific type
     *
     * @param string $type
     * @param string $response_style
     * @return array|collections
     */
    function BBClasses($type = 'text', $response_style = 'collection')
    {
        $data = Classes::where('type', $type)->get();

        return ($response_style == 'collection') ? $data : $data->toArray();
    }
}

if (!function_exists('BBClassesList')) {

    /**
     * Provide a collection of classes of specific type in lists style
     *
     * @param string $type
     * @return Laravel Lists
     */
    function BBClassesList($type = 'text')
    {
        $lists = Classes::where('type', $type)->lists('name', 'id');
        $lists->prepend('Select Class', '');

        return $lists;
    }
}


if (!function_exists('BBClassVariations')) {

    /**
     * Provide a collection / array of all variaions of given class
     *
     * @param null $id
     * @param string $response_style
     * @return array|collections
     * @internal param string $type
     * @internal param string $response_style
     */
    function BBClassVariations($id = null, $response_style = 'collection')
    {
        $result = null;
        if ($id) {
            $rs = Classes::find($id);
            $data = $rs->variations;
            if ($data) {
                $result = ($response_style == 'collection') ? $data : $data->toArray();
            }
        }

        return $result;
    }
}
if (!function_exists('BBClassVariationsList')) {

    /**
     * Provide a Lists of all variaions of given class
     *
     * @param null $id
     * @return Lists
     */
    function BBClassVariationsList($id = null)
    {
        $result = null;
        if ($id) {
            $rs = Classes::find($id);
            $result = $rs->variations->lists('title', 'id');
        }
        return $result->toJson();
    }
}


if (!function_exists('BBCoreAssests')) {

    /**
     * Provide a collection / arrry of all Core Assests
     *
     * @param string $response_style
     * @return array|collections
     * @internal param string $type
     */
    function BBCoreAssests($response_style = 'collection')
    {
        $data = Assest::get();

        return ($response_style == 'collection') ? $data : $data->toArray();
    }
}

if (!function_exists('BBCoreAssest')) {

    /**
     * Provide a collection / array of core Assest in detail
     *
     * @param null $id
     * @param string $response_style
     * @return array|collections
     * @internal param string $type
     * @internal param string $response_style
     */
    function BBCoreAssest($id = null, $response_style = 'collection')
    {
        $result = null;
        if ($id) {
            $data = Assest::find($id);
            if ($data) {
                $result = ($response_style == 'collection') ? $data : $data->toArray();
            }
        }

        return $result;
    }
}
if (!function_exists('BBFontLibs')) {

    /**
     * Provide list of all available fonts Libs
     *
     * @return array
     */
    function BBFontLibs()
    {
        $fonts = File::directories('public/fonts');
        foreach ($fonts as $font) {
            if (file_exists($font . '/config.json')) {
                $config = json_decode(file_get_contents($font . '/config.json'));
                $resources[] = [
                    'title' => $config->title,
                    'folder' => basename($font)
                ];
            }
        }

        return $resources;
    }
}


