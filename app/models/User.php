<?php

namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class User
 *
 */
class User extends BaseModel implements UserInterface, RemindableInterface
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
     * function posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('Post');
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
        unset($params['password_confirmation']);
        $params['password'] = \Hash::make($params['password']);

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
        unset($params['password_confirmation']);
        if (trim($params['password']) != '') {
            $params['password'] = \Hash::make($params['password']);
        } else {
            unset($params['password']);
        }

        return parent::updateRecord($record, $params);
    }

}