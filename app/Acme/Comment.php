<?php namespace Acme;

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
     * @var array
     *
     */
    protected $fillable = [
        'name',
        'email',
        'body',
        'post_id'
    ];

    /**
     * function post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('Acme\Post');
    }

}