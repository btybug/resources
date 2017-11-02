<?php namespace Btybug\Resources\Interfases;

/**
 * Interface vInterfase
 * @package App\Modules\Packeges\Interfases
 */
interface vInterfase
{
    /**
     * @param array $data
     * @return mixed
     */
    public function check(array $data);

    /**
     * @param $path
     * @return mixed
     */
    public function json($path);

    /**
     * @param $file
     * @return mixed
     */
    public function isCompress($file);

}
