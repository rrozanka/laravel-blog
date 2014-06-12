<?php namespace Acme\Repositories;

/**
 * Interface PostRepositoryInterface
 *
 * @package Acme\Repositories
 */
interface PostRepositoryInterface
{

    /**
     * function get all
     *
     * @return mixed
     */
    public function getAll();

    /**
     * function get by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function getById($id);

    /**
     * function create
     *
     * @param $data
     *
     * @return mixed
     */
    public function create($data);

    /**
     * function update
     *
     * @param $record
     * @param $data
     *
     * @return mixed
     */
    public function update($record, $data);

    /**
     * function delete
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id);

    /**
     * function search
     *
     * @param $q
     *
     * @return mixed
     */
    public function search($q);

}