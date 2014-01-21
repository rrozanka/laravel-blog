<?php

namespace App\Controllers\Admin;
use App\Models\Setting;

/**
 * Class SettingsController
 *
 */
class SettingsController extends \BaseController {

    /**
     * construct function
     *
     */
    public function __construct()
    {
        $this->beforeFilter('admin');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $settings = Setting::getSettings();

        return \View::make('admin.settings.index')
            ->with('settings', $settings);
	}

    /**
     * postStore action
     *
     */
    public function postStore()
    {
        Setting::saveSettings(\Input::get('settings'));

        return \Redirect::to('admin/settings/index')
            ->with('message', 'Settings has been saved successfully')
            ->with('messageType', 'success');
    }

}