<?php namespace Acme\Repositories;

/**
 * Interface SettingRepositoryInterface
 *
 * @package Acme\Repositories
 */
interface SettingRepositoryInterface
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
     * function get settings
     *
     * @return mixed
     */
    public static function getSettings();

    /**
     * function get by key
     *
     * @param $key
     *
     * @return mixed
     */
    public static function getByKey($key);

    /**
     * function get value by key
     *
     * @param $key
     *
     * @return mixed
     */
    public static function getValueByKey($key);

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
     * function save settings
     *
     * @param $settings
     *
     * @return mixed
     */
    public static function saveSettings($settings);

}