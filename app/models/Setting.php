<?php

namespace App\Models;

/**
 * Class Setting
 *
 */
class Setting extends \Eloquent
{

    /**
     * function save settings
     *
     * @param array $settings settings
     *
     * @return void|boolean
     */
    public static function saveSettings($settings)
    {
        if (!$settings) {
            return false;
        }

        // save each setting
        foreach ($settings as $key => $value) {
            if (!($record = self::getByKey($key))) {
                $record = new Setting();
            }

            $record->key = $key;
            $record->value = $value;
            $record->save();
        }
    }

    /**
     * function get settings
     *
     * @return array
     */
    public static function getSettings()
    {
        $temp = [];
        $settings = Setting::all();
        if ($settings->count()) {
            foreach ($settings as $setting) {
                $temp[$setting->key] = $setting->value;
            }
        }

        return $temp;
    }

    /**
     * function get by key
     *
     * @param string $key key
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public static function getByKey($key)
    {
        return Setting::where('key', '=', $key)->first();
    }

    /**
     * function get value by key
     *
     * @param string $key key
     *
     * @return string|boolean
     */
    public static function getValueByKey($key)
    {
        if (($setting = self::getByKey($key))) {
            return $setting->value;
        }

        return false;
    }

}