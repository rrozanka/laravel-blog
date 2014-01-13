<?php

namespace App\Models;

/**
 * Class Tag
 *
 */
class Tag extends \Eloquent
{

    /**
     * @var array rules
     *
     */
    public static $rules = [
        'name' => 'required'
    ];

}
