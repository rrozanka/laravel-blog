<?php namespace Acme;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('Acme\Post');
    }

}