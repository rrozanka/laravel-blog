<?php namespace Acme\Repositories;

use Acme\Category;

/**
 * Class DbCategoryRepository
 *
 * @package Acme\Repositories
 */
class DbCategoryRepository implements CategoryRepositoryInterface
{

    /**
     * function get all
     *
     * @return mixed
     */
    public function getAll()
    {
        return Category::all();
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
        return Category::findOrFail($id);
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
        $record = Category::create($data);

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
        $record = Category::findOrFail($id);
        $record->delete();

        return true;
    }

}