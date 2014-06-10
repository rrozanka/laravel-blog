<?php namespace Acme\Repositories;

use Acme\User;

/**
 * Class DbUserRepository
 *
 * @package Acme\Repositories
 */
class DbUserRepository implements UserRepositoryInterface
{

    /**
     * function get all
     *
     * @return mixed
     */
    public function getAll()
    {
        return User::all();
    }

    /**
     * function get by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * function create
     *
     * @param $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $data['password'] = \Hash::make($data['password']);

        $record = User::create($data);

        return $record;
    }

    /**
     * function update
     *
     * @param $record
     * @param $data
     *
     * @return mixed
     */
    public function update($record, $data)
    {
        if (trim($data['password']) == '')
        {
            unset($data['password']);
        }

        $record->fill($data);
        $record->save();

        return $record;
    }

    /**
     * function delete
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $record = User::findOrFail($id);
        $record->delete();

        return true;
    }

}