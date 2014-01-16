<?php

namespace App\Models;

/**
 * Class Comment
 *
 */
class Comment extends \Eloquent
{

    /**
     * @var array rules
     *
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'body' => 'required',
    ];

    /**
     * function post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('\App\Models\Post');
    }

}