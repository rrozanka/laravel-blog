<?php namespace Acme\Repositories;

use Acme\Setting;

/**
 * Class DbSettingRepository
 *
 * @package Acme\Repositories
 */
class DbSettingRepository implements SettingRepositoryInterface
{

    /**
     * function get all
     *
     * @return mixed
     */
    public function getAll()
    {
        return Setting::all();
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
        return Setting::findOrFail($id);
    }

    /**
     * function get settings
     *
     * @return mixed
     */
    public static function getSettings()
    {
        $temp = [];
        $settings = Setting::all();
        if ($settings->count())
        {
            foreach ($settings as $setting)
            {
                $temp[$setting->key] = $setting->value;
            }
        }

        return $temp;
    }

    /**
     * function get by key
     *
     * @param $key
     *
     * @return mixed
     */
    public static function getByKey($key)
    {
        return Setting::where('key', '=', $key)->first();
    }

    /**
     * function get value by key
     *
     * @param $key
     *
     * @return mixed
     */
    public static function getValueByKey($key)
    {
        if (($setting = self::getByKey($key)))
        {
            return $setting->value;
        }

        return false;
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
        $record = Setting::create($data);

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
        $record = Setting::findOrFail($id);
        $record->delete();

        return true;
    }

    /**
     * function save settings
     *
     * @param $settings
     *
     * @return mixed
     */
    public static function saveSettings($settings)
    {
        if (!$settings)
        {
            return false;
        }

        // save each setting
        foreach ($settings as $key => $value)
        {
            if (!($record = self::getByKey($key)))
            {
                $record = new Setting();
            }

            $record->key = $key;
            $record->value = $value;
            $record->save();
        }
    }
}