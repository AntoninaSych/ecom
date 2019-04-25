<?php
namespace App\Http\Controllers;

use App\Classes\LogicalModels\RoleRepository;
use App\Classes\LogicalModels\SettingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\Requests\Setting\UpdateSettingOverallRequest;

class SettingsController extends Controller
{
    protected $settings;
    protected $roles;


    public function __construct(
        SettingRepository $settings,
        RoleRepository $roles
    )
    {
        $this->settings = $settings;
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('settings.index')
         //   ->withSettings($this->settings->getSetting())
            ->withPermission($this->roles->allPermissions())
            ->withRoles($this->roles->allRoles());
    }

    /**
     * @param UpdateSettingOverallRequest $request
     * @return mixed
     */
    public function updateOverall(UpdateSettingOverallRequest $request)
    {
        $this->settings->updateOverall($request);
        Session::flash('flash_message', 'Overall settings successfully updated');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function permissionsUpdate(Request $request)
    {
        $this->roles->permissionsUpdate($request);
        Session::flash('flash_message', 'Role is updated');
        return redirect()->back();
    }


}
