<?php namespace Acme\Repositories;

use Acme\Tag;

/**
 * Class DbTagRepository
 *
 * @package Acme\Repositories
 */
class DbTagRepository implements TagRepositoryInterface
{

    /**
     * function get all
     *
     * @return mixed
     */
    public function getAll()
    {
        return Tag::all();
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
        return Tag::findOrFail($id);
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
        $record = Tag::create($data);

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
        $record = Tag::findOrFail($id);
        $record->delete();

        return true;
    }

}