<?php namespace Acme;

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
        'short_body' => 'required|min:2',
        'body' => 'required|min:2'
    ];

    /**
     * @var array
     *
     */
    protected $fillable = [
        'name',
        'short_body',
        'body',
        'user_id',
        'category_id'
    ];

    /**
     * function user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Acme\User');
    }

    /**
     * function category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Acme\Category');
    }

    /**
     * function tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Acme\Tag');
    }

    /**
     * function comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Acme\Comment');
    }

}