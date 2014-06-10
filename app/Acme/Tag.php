<?php namespace Acme;

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

    /**
     * @var array
     *
     */
    protected $fillable = [
        'name'
    ];

    /**
     * function posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function posts()
    {
        return $this->belongsToMany('Acme\Post');
    }

}