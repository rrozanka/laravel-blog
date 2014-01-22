<?php

namespace App\Models;

/**
 * Class Tag
 *
 */
class Tag extends BaseModel
{

    /**
     * @var array rules
     *
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * function posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function posts()
    {
        return $this->belongsToMany('\App\Models\Post');
    }

}