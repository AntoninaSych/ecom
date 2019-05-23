<?php

use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //setup Roles
        $owner = new Role();
        $owner->name         = 'administrator';
        $owner->display_name = 'Administrator'; // optional
        $owner->description  = 'Administrator role'; // optional
        $owner->save();


        $owner = new Role();
        $owner->name         = 'call_center';
        $owner->display_name = 'Call Center'; // optional
        $owner->description  = 'Call Center role'; // optional
        $owner->save();

        $owner = new Role();
        $owner->name         = 'business';
        $owner->display_name = 'Business'; // optional
        $owner->description  = 'Business role'; // optional
        $owner->save();

        $owner = new Role();
        $owner->name         = 'fraud_monitoring';
        $owner->display_name = 'Fraud Monitoring'; // optional
        $owner->description  = 'Fraud Monitoring role'; // optional
        $owner->save();

        $owner = new Role();
        $owner->name         = 'developer';
        $owner->display_name = 'Developer'; // optional
        $owner->description  = 'Developer role'; // optional
        $owner->save();

        $owner = new Role();
        $owner->name         = 'security';
        $owner->display_name = 'Security Department'; // optional
        $owner->description  = 'Security role'; // optional
        $owner->save();
        //end setup roles

        //setup users
        $user = new User();
        $user->name = 'Business User';
        $user->email = 'business@gmail.com';
        $user->password = Hash::make('password');
        $user->save();

        $user = new User();
        $user->name = 'Administrator User';
        $user->email = 'administrator@gmail.com';
        $user->password = Hash::make('password');
        $user->save();


        $user = new User();
        $user->name = 'Fraud User';
        $user->email = 'fraud@gmail.com';
        $user->password = Hash::make('password');
        $user->save();

        $user = new User();
        $user->name = 'CallCenter User';
        $user->email = 'callcenter@gmail.com';
        $user->password = Hash::make('password');
        $user->save();

        $user = new User();
        $user->name = 'Developer User';
        $user->email = 'developer@gmail.com';
        $user->password = Hash::make('password');
        $user->save();

        $user = new User();
        $user->name = 'Security User';
        $user->email = 'security@gmail.com';
        $user->password = Hash::make('password');
        $user->save();
        //end setup users


        //setup roles for users
        $roles = new Role();

        $business = $roles->where('name', '=', 'business')->first();
        $user = User::where('email', '=', 'business@gmail.com')->first();
        $user->attachRole($business);

        $callcenter = $roles->where('name', '=', 'call_center')->first();
        $user = User::where('email', '=', 'callcenter@gmail.com')->first();
        $user->attachRole($callcenter);

        $fraud = Role::where('name', '=', 'fraud_monitoring')->first();
        $user = User::where('email', '=', 'fraud@gmail.com')->first();
        $user->attachRole($fraud);

        $admin = Role::where('name', '=', 'administrator')->first();
        $user = User::where('email', '=', 'administrator@gmail.com')->first();
        $user->attachRole($admin);

        $developer = Role::where('name', '=', 'developer')->first();
        $user = User::where('email', '=', 'developer@gmail.com')->first();
        $user->attachRole($developer);

        $security = Role::where('name', '=', 'security')->first();
        $user = User::where('email', '=', 'security@gmail.com')->first();
        $user->attachRole($security);


        //setup permissions
        $permission = new Permission();
        $permission->name         = 'manage-users';
        $permission->display_name = 'Manage Users'; // optional
        $permission->description  = 'Create/update users'; // optional
        $permission->save();

        $permission = new Permission();
        $permission->name         = 'view-payments';
        $permission->display_name = 'View payments'; // optional
        $permission->description  = 'View payments page'; // optional
        $permission->save();

        $permission = new Permission();
        $permission->name         = 'add-user';
        $permission->display_name = 'Add user'; // optional
        $permission->description  = 'Add user and assign initial role'; // optional
        $permission->save();



        //attach permission to role

        $permission = Permission::where('name', '=', 'manage-users')->first();
        $adminRole = Role::where('name', '=', 'developer')->first();
        $adminRole->attachPermission($permission);

        $permission = Permission::where('name', '=', 'add-user')->first();
        $adminRole = Role::where('name', '=', 'administrator')->first();
        $adminRole->attachPermission($permission);

        /*$permission = Permission::where('name', '=', 'add-user')->first();
        $adminRole = Role::where('name', '=', 'administrator')->first();
        $adminRole->attachPermission($permission);*/
    }
}
