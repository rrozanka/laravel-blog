<?php

namespace App\Controllers;
use App\Models\Setting;

/**
 * Class SettingsController
 *
 */
class SettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $settings = Setting::getSettings();

        return \View::make('settings.index')
            ->with('settings', $settings);
	}

    /**
     * postStore action
     *
     */
    public function postStore()
    {
        Setting::saveSettings(\Input::get('settings'));

        return \Redirect::to('settings/index')
            ->with('message', 'Settings has been saved successfully')
            ->with('messageType', 'success');
    }

}