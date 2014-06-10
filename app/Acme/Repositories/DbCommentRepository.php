<?php namespace Acme\Repositories;

use Acme\Comment;

/**
 * Class DbCommentRepository
 *
 * @package Acme\Repositories
 */
class DbCommentRepository implements CommentRepositoryInterface
{

    /**
     * function get all
     *
     * @return mixed
     */
    public function getAll()
    {
        return Comment::all();
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
        return Comment::findOrFail($id);
    }

    /**
     * function create
     *
     * @param $postId
     * @param $data
     *
     * @return mixed
     */
    public function create($postId, $data)
    {
        $data['post_id'] = $postId;

        $record = Comment::create($data);

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
        $record = Comment::findOrFail($id);
        $record->delete();

        return true;
    }

}