<?php

namespace App\Models;

/**
 * Class Post
 *
 */
class Post extends BaseModel
{

    /**
     * @var array rules
     *
     */
    public static $rules = [
        'name' => 'required|min:2',
        'category' => 'required|numeric',
        'short_body' => 'required|min:2',
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

    /**
     * function tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('\App\Models\Tag');
    }

    /**
     * function comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * function store record
     *
     * @param array $params params
     *
     * @return object
     */
    public static function storeRecord($params)
    {
        $params['category_id'] = $params['category'];
        $params['user_id'] = \Auth::user()->id;
        unset($params['tags']);
        unset($params['category']);

        return parent::storeRecord($params);
    }

    /**
     * function update record
     *
     * @param object $record record
     * @param array $params params
     *
     * @return mixed
     */
    public static function updateRecord($record, $params)
    {
        $params['category_id'] = $params['category'];
        unset($params['tags']);
        unset($params['category']);

        return parent::updateRecord($record, $params);
    }

}
