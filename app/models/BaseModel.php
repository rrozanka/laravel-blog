<?php

namespace App\Models;

/**
 * Class Category
 *
 */
class BaseModel extends \Eloquent
{

    /**
     * function get called class
     *
     * @return mixed
     */
    public static function getCalledClass()
    {
        $class = get_called_class();

        return new $class;
    }

    /**
     * function set record params
     *
     * @param object $record record
     * @param array $params params
     *
     * @return void
     */
    public static function setRecordParams($record, $params)
    {
        foreach ($params as $key => $value) {
            if (substr($key, 0, 1) == '_') {
                continue;
            }

            $record->{$key} = $value;
        }
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
        $record = self::getCalledClass();
        self::setRecordParams($record, $params);
        $record->save();

        return $record;
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
        self::setRecordParams($record, $params);
        $record->save();

        return $record;
    }

}