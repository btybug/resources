<?php
/**
 * Copyright (c) 2016.
 * *
 *  * Created by PhpStorm.
 *  * User: Edo
 *  * Date: 10/3/2016
 *  * Time: 10:44 PM
 *
 */

namespace Btybug\Resources\Models\Files;

use App\Modules\Resources\Models\Files\traits\FilesPreview;
use Sahakavatar\Cms\Models\Eloquent\Abstractions\TplModel;

/**
 * Created by PhpStorm.
 * User: Comp1
 * Date: 11/24/2016
 * Time: 4:58 PM
 */
class FilesBB extends TplModel
{
    use FilesPreview;

    public function __construct()
    {
        $this->dir = config('paths.files_path');
        $this->json = config('paths.files_path') . 'files.json';
        $this->uf = base_path(config('paths.ui_elements_uplaod'));
    }
}