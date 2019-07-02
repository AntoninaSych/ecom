<?php

namespace App\Http\Controllers;

use App\Classes\LogicalModels\RoleRepository;
use App\Classes\LogicalModels\SettingRepository;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\Requests\Setting\UpdateSettingOverallRequest;

class SettingsController extends Controller
{
    use ResetsPasswords;
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

    public function changePassword()
    {
        return view('users.changePassword');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = User::find(Auth::id());

        if (Hash::check($request->get('password_current'), $user->password)) {

            $user->password = Hash::make($request->get('password'));
            $user->save();
            Session::flash('success', 'Пароль успешно изменен');

            return redirect()->back();
        }
        Session::flash('error', 'Ошибка при изменении пароля');

        return redirect()->back();
    }
}
