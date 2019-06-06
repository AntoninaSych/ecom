<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name         = 'merchant-view';
        $permission->display_name = 'View merchants'; // optional
        $permission->description  = 'View merchants'; // optional
        $permission->save();

        $permission = new Permission();
        $permission->name         = 'process-log-view';
        $permission->display_name = 'View processing'; // optional
        $permission->description  = 'View payment processing'; // optional
        $permission->save();

        $permission = new Permission();
        $permission->name         = 'manage-mcc';
        $permission->display_name = 'Manage mcc'; // optional
        $permission->description  = 'Manage mcc'; // optional
        $permission->save();

        $permission = new Permission();
        $permission->name         = 'manage-merchant';
        $permission->display_name = 'Manage merchants'; // optional
        $permission->description  = 'Manage merchants'; // optional
        $permission->save();


        $permission = new Permission();
        $permission->name         = 'apply-merchants-requests';
        $permission->display_name = 'Apply merchants requests'; // optional
        $permission->description  = 'Apply merchants requests'; // optional
        $permission->save();




        $permission = new Permission();
        $permission->name         = 'manage-merchant-payment-type';
        $permission->display_name = 'Manage payment type';
        $permission->description  = 'Manage payment type';
        $permission->save();
    }
}
