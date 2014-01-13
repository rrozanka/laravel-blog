<?php

namespace App\Models;

/**
 * Class Post
 *
 */
class Post extends \Eloquent
{

    /**
     * @var array rules
     *
     */
    public static $rules = [
        'name' => 'required|min:2',
        'category' => 'required|numeric',
        'body' => 'required|min:2'
    ];

    /**
     * function user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    /**
     * function category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('\App\Models\Category');
    }

}
