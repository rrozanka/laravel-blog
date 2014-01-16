<?php

/**
 * Class ViewHelper
 *
 */
class ViewHelper
{

    /**
     * function output date
     *
     * @param string $date date
     * @param string $format format
     *
     * @return string
     */
    public static function outputDate($date, $format = 'M d, Y')
    {
        $dateTime = new DateTime($date);

        return $dateTime->format($format);
    }

}