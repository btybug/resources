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

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/4/2016
 * Time: 10:55 PM
 */

namespace Btybug\Resources\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Styles
 * @package App\Modules\Resources\Models
 */
class Styles extends Model
{
    /**
     * @var array
     */
    public static $stylesTypes = [
        'text' => 'text', 'image' => 'image', 'breadcrumb' => 'breadcrumb', 'animation' => 'animation',
        'container' => 'container', 'fields' => 'fields', 'buttons' => 'buttons', 'notification' => 'notification', 'menu' => 'menu', 'others' => 'others'
    ];
    /**
     * @var array
     */
    public $messages = [
        'unique_whit_colume' => 'The :attribute is unique',
    ];
    /**
     * @var string
     */
    protected $table = 'styles';
    /**
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @param $type
     * @return mixed
     */
    public static function getTypeStyles($type)
    {
        return self::where('type', $type)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Modules\Resources\Models\StyleItems', 'style_id');
    }


}
