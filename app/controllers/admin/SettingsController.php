<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Acme\Repositories\SettingRepositoryInterface;

/**
 * Class SettingsController
 *
 */
class SettingsController extends BaseController {


    /**
     * @var SettingRepositoryInterface
     *
     */
    protected $setting;

    /**
     * function construct
     *
     */
    public function __construct(SettingRepositoryInterface $setting)
    {
        $this->setting = $setting;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $settings = $this->setting->getSettings();

        return \View::make('admin.settings.index')
            ->withSettings($settings);
	}

    /**
     * postStore action
     *
     */
    public function postStore()
    {
        $this->setting->saveSettings(\Input::get('settings'));

        return \Redirect::to('admin/settings/index')
            ->with('message', 'Settings has been saved successfully')
            ->with('messageType', 'success');
    }

}