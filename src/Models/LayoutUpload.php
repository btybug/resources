<?php namespace Btybug\Resources\Models;

use File;
use Illuminate\Http\Request;
use Sahakavatar\Cms\Helpers\helpers;
use Zipper;

/**
 * Class ThUpload
 * @package App\Modules\Developers\Model
 */
class LayoutUpload
{
    /**
     *
     */
    const ZIP = ".zip";
    /**
     * @var mixed
     */
    public $uf;
    /**
     * @var
     */
    public $fileNmae;
    /**
     * @var
     */
    public $helper;
    /**
     * @var
     */
    public $generatedName;

    /**
     * @var
     */
    protected $dir;

    /**
     * TplUpload constructor.
     */
    public function __construct()
    {
        $this->helpers = new helpers;
        $this->uf = config('paths.backend_themes_upl');
        $this->thstub = config('paths.backend_themes_stub');
        $this->thsettingsstub = config('paths.backend_themes_settings_stub');
    }

    /**
     * @param $data
     * @param $code
     * @param null $links
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function ResponseSuccess($data, $code, $links = null, $id = null)
    {
        return \Response::json(['data' => $data, 'invalid' => false, 'id' => $id, 'links' => $links, 'code' => $code, 'error' => false], $code);
    }

    /**
     * @param $data
     * @param $code
     * @param $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function ResponseInvalid($data, $code, $messages)
    {
        return \Response::json(['data' => $data, 'invalid' => true, 'messages' => $messages, 'code' => $code, 'error' => false], $code);
    }

    /**
     * @param $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function ResponseError($message, $code)
    {
        return \Response::json(['message' => $message, 'code' => $code, 'error' => true], $code);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function upload(Request $request)
    {

        if ($request->hasFile('file')) {

            $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
            $zip_file = $request->file('file')->getClientOriginalName();
            $this->fileNmae = str_replace(self::ZIP, "", $zip_file);
            $request->file('file')->move($this->uf, $zip_file); // uploading file to given path

            try {
                $this->extract();
            } catch (Exception $e) {
                return ['message' => $e->getMessage(), 'code' => $e->getCode(), 'error' => true];
            }

            return ['folder' => $this->generatedName, 'data' => $this->fileNmae, 'code' => 200, 'error' => false];
        }
    }

    /**
     *
     */
    public function extract()
    {
        $fileName = $this->fileNmae;
        $this->generatedName = $fileName . '_' . uniqid();
        File::makeDirectory($this->uf . $this->generatedName);
        Zipper::make($this->uf . "/" . $fileName . self::ZIP)->extractTo($this->uf . $this->generatedName . '/');
    }

    /**
     * @param $folder
     * @param $name
     * @return array|string
     */
    public function validatConfAndMoveToMain($folder, $name)
    {
        if (File::exists($this->uf . $folder . '/' . 'config.json')) {
            $file = $this->uf . $folder . '/' . 'config.json';
            $response = $this->validate($file, $folder);

            if ($response['error'])
                return $response;

            $this->dir = config('paths.backend_layouts') . '/' . $response['data']['folder'];

            File::copyDirectory($this->uf . $folder, $this->dir);

            return $response;
        } else {
            if (File::exists($this->uf . $folder . '/' . $name . '/' . 'config.json')) {
                $file = $this->uf . $folder . '/' . $name . '/' . 'config.json';
                $response = $this->validate($file, $folder);

                if ($response['error'])
                    return $response;

                $this->dir = config('paths.backend_layouts') . '/' . $response['data']['folder'];

                File::copyDirectory($this->uf . $folder . '/' . $name, $this->dir);

                return $response;
            } else {
                return ['error' => 'true', 'message' => 'config.json file is not exists'];
            }
        }

        return $this->uf . '/' . 'config.json';
    }

    /**
     * @param $file
     * @param $key
     * @return array
     */
    private function validate($file, $key)
    {
        $conf = File::get($file);
        if ($conf) {
            $conf = json_decode($conf, true);
            if (!isset($conf['layout']))
                return ['message' => 'Layout key are required, set your html name under layout key', 'code' => '404', 'error' => true];

            $conf['slug'] = (string)$key;
            $conf['created_at'] = time('now');
            $conf['folder'] = $this->fileNmae;
            $json = json_encode($conf, true);
            File::put($file, $json);

            ///generate Layout
            $this->generateLayout($conf);
            //generate Settings
            $this->generateSettings($conf);

            return ['data' => $conf, 'code' => '200', 'error' => false];
        }

        return ['message' => 'Json file is empty !!!', 'code' => '404', 'error' => true];
    }

    /**
     * @param $conf
     */
    private function generateLayout($conf)
    {
        $pathHtml = $this->uf . $conf['slug'] . '/' . $conf['folder'] . '/' . $conf['layout'] . '.html';
        if (File::exists($pathHtml)) {
            $fileReq = File::get($pathHtml);
            $body = helpers::between('<body>', '</body>', $fileReq);

            $body = str_replace('<!--content-->', ' @yield(\'main_content\')', $body);
            $css = '@push("css")' . "\r\n";
            if (isset($conf['css'])) {
                if (count($conf['css'])) {
                    foreach ($conf['css'] as $cs) {
                        if (File::exists($this->uf . $conf['slug'] . '/' . $conf['folder'] . '/css/' . $cs)) {
                            $css .= '{!! HTML::style("/resources/views/ContentLayouts/' . $conf['folder'] . '/css/' . $cs . '") !!}' . "\r\n";
                        }
                    }
                    $css .= '@endpush' . "\r\n";
                }
            }
            $js = '@push("javascript")' . "\r\n";
            if (isset($conf['js'])) {
                if (count($conf['js'])) {
                    foreach ($conf['js'] as $j) {
                        if (File::exists($this->uf . $conf['slug'] . '/' . $conf['folder'] . '/js/' . $j)) {
                            $js .= '{!! HTML::script("/resources/views/ContentLayouts/' . $conf['folder'] . '/js/' . $j . '") !!}' . "\r\n";
                        }
                    }
                    $js .= "@endpush";
                }
            }
            $bladePath = $this->uf . $conf['slug'] . '/' . $conf['folder'] . '/' . $conf['layout'] . '.blade.php';
            $body = $body . "\r\n" . $css . "\r\n" . $js;
            File::put($bladePath, $body);
        }
    }

    private function generateSettings($conf)
    {
        $pathHtml = $this->uf . $conf['slug'] . '/' . $conf['folder'] . '/' . $conf['settings']['file'] . '.html';
        if (File::exists($pathHtml)) {
            $fileReq = File::get($pathHtml);
            $body = helpers::between('<body>', '</body>', $fileReq);

            $css = '@push("css")' . "\r\n";
            if (isset($conf['css'])) {
                if (count($conf['css'])) {
                    foreach ($conf['css'] as $cs) {
                        if (File::exists($this->uf . $conf['slug'] . '/' . $conf['folder'] . '/css/' . $cs)) {
                            $css .= '{!! HTML::style("/resources/views/ContentLayouts/' . $conf['folder'] . '/css/' . $cs . '") !!}' . "\r\n";
                        }
                    }
                    $css .= '@endpush' . "\r\n";
                }
            }
            $js = '@push("javascript")' . "\r\n";
            if (isset($conf['js'])) {
                if (count($conf['js'])) {
                    foreach ($conf['js'] as $j) {
                        if (File::exists($this->uf . $conf['slug'] . '/' . $conf['folder'] . '/js/' . $j)) {
                            $js .= '{!! HTML::script("/resources/views/ContentLayouts/' . $conf['folder'] . '/js/' . $j . '") !!}' . "\r\n";
                        }
                    }
                    $js .= "@endpush";
                }
            }

            $bladePath = $this->uf . $conf['slug'] . '/' . $conf['folder'] . '/' . $conf['settings']['file'] . '.blade.php';
            $body = $body . "\r\n" . $css . "\r\n" . $js;
            File::put($bladePath, $body);
        }
    }

    /**
     * @param $fileName
     */
    public function deleteFolderZip($fileName)
    {
        File::deleteDirectory($this->uf . $fileName);
        File::delete($this->uf . $fileName . self::ZIP);
    }

}
