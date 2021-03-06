<?php

namespace App\Models;

/**
 * Class Utils
 *
 */
class Utils
{

    /**
     * function to select format
     *
     * @param object $records records
     * @param string|null $emptyRowText empty row text
     *
     * @return array|boolean
     */
    public static function toSelectFormat($records, $emptyRowText = null)
    {
        $ret = ($emptyRowText !== null) ? ['' => $emptyRowText] : [];
        if ($records) {
            foreach ($records as $record) {
                $ret[$record->id] = $record->name;
            }
        }

        return $ret;
    }

    /**
     * function get ids
     *
     * @param object $records records
     *
     * @return array
     */
    public static function getIds($records)
    {
        $ret = [];
        if ($records) {
            foreach ($records as $record) {
                $ret[] = $record->id;
            }
        }

        return $ret;
    }

}