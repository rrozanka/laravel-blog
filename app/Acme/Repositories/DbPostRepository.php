<?php namespace Acme\Repositories;

use Acme\Post;

/**
 * Class DbPostRepository
 *
 * @package Acme\Repositories
 */
class DbPostRepository implements PostRepositoryInterface
{

    /**
     * function get all
     *
     * @return mixed
     */
    public function getAll()
    {
        return Post::all();
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
        return Post::findOrFail($id);
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
        $data['category_id'] = $data['category'];
        $data['user_id'] = \Auth::user()->id;

        $record = Post::create($data);

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
        $data['category_id'] = $data['category'];

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
        $record = Post::findOrFail($id);
        $record->delete();

        return true;
    }

}