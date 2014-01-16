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

    /**
     * function short
     *
     * @param string $text text to short
     * @param integer $length length
     *
     * @return string
     */
    public static function short($text, $length)
    {
        $extra = '';
        if (strlen($text) > $length) {
            $extra = '...';
        }

        return substr($text, 0, $length) . $extra;
    }

}