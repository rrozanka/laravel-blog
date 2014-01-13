<?php

namespace App\Models;

/**
 * Class Category
 *
 */
class Category extends \Eloquent
{

    /**
     * @var array rules
     *
     */
    public static $rules = [
        'name' => 'required'
    ];

}