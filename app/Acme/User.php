<?php namespace Acme;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class User
 *
 * @package Acme
 */
class User extends \Eloquent implements UserInterface, RemindableInterface
{

    /**
     * @var array rules
     *
     */
    public static $rules = [
        'firstname' => 'required|alpha|min:2',
        'lastname' => 'required|alpha|min:2',
        'email' => 'required|email|unique:users',
        'password' => 'required|alpha_num|between:6,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:6,12',
        'role' => 'required'
    ];

    /**
     * @var array
     *
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * @var string admin role
     *
     */
    public static $adminRole = 'admin';

    /**
     * @var string author role
     *
     */
    public static $authorRole = 'author';

    /**
     * function posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('Acme\Post');
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return parent::getRememberToken();
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        return parent::setRememberToken();
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return parent::getRememberTokenName();
    }

}