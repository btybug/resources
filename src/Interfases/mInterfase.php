<?php namespace Btybug\Resources\Interfases;

/**
 * Interface mInterfase
 * @package App\Modules\Packeges\Interfases
 */
interface mInterfase
{

    /**
     * @param $modul
     * @return mixed
     */
    public function modul_migrate_up($modul);

    /**
     * @param $modul
     * @return mixed
     */
    public function modul_migrate_down($modul);
}
