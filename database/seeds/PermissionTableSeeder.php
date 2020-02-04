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

       if(is_null($permission->select()->where('name','merchant-view')->first()))
       {
           $permission->name         = 'merchant-view';
           $permission->display_name = 'View merchants'; // optional
           $permission->description  = 'View merchants'; // optional
           $permission->save();
       }



        $permission = new Permission();
        if(is_null($permission->select()->where('name','process-log-view')->first())) {
            $permission->name = 'process-log-view';
            $permission->display_name = 'View processing'; // optional
            $permission->description = 'View payment processing'; // optional
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','manage-mcc')->first())) {
            $permission->name = 'manage-mcc';
            $permission->display_name = 'Manage mcc'; // optional
            $permission->description = 'Manage mcc'; // optional
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','manage-merchant')->first())) {
            $permission->name = 'manage-merchant';
            $permission->display_name = 'Manage merchants'; // optional
            $permission->description = 'Manage merchants'; // optional
            $permission->save();
        }


        $permission = new Permission();
        if(is_null($permission->select()->where('name','apply-merchants-requests')->first())) {
            $permission->name = 'apply-merchants-requests';
            $permission->display_name = 'Apply merchants requests'; // optional
            $permission->description = 'Apply merchants requests'; // optional
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','manage-merchant-payment-type')->first())) {
            $permission->name = 'manage-merchant-payment-type';
            $permission->display_name = 'Manage payment type';
            $permission->description = 'Manage payment type';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','manage-merchant-route')->first())) {
            $permission->name = 'manage-merchant-route';
            $permission->display_name = 'Manage merchant payment route';
            $permission->description = 'Manage merchant payment route';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','view-statistic')->first())) {
            $permission->name = 'view-statistic';
            $permission->display_name = 'View statistic';
            $permission->description = 'View statistic';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','manage-users')->first())) {
            $permission->name = 'manage-users';
            $permission->display_name = 'Manage users';
            $permission->description = 'Manage users';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','view-payments')->first())) {
            $permission->name = 'view-payments';
            $permission->display_name = 'View payments';
            $permission->description = 'View payments';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','add-user')->first())) {
            $permission->name = 'add-user';
            $permission->display_name = 'Add user';
            $permission->description = 'Add user';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','view-reestrs')->first())) {
            $permission->name = 'view-reestrs';
            $permission->display_name = 'View reestrs';
            $permission->description = 'View reestrs';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','view-routes')->first())) {
            $permission->name = 'view-routes';
            $permission->display_name = 'View routes';
            $permission->description = 'View routes';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','merchant-user-alias')->first())) {
            $permission->name = 'merchant-user-alias';
            $permission->display_name = 'View merchant user alias';
            $permission->description = 'View merchant user alias';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','view-front-users')->first())) {
            $permission->name = 'view-front-users';
            $permission->display_name = 'View front users';
            $permission->description = 'View front users';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','add-snippets-routes')->first())) {
            $permission->name = 'add-snippets-routes';
            $permission->display_name = 'View add snippets routes';
            $permission->description = 'View add snippets routes';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','make-request-status')->first())) {
            $permission->name = 'make-request-status';
            $permission->display_name = 'Make request status';
            $permission->description = 'Make request status';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','make-response-status')->first())) {
            $permission->name = 'make-response-status';
            $permission->display_name = 'Make make response status';
            $permission->description = 'Make make response status';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','manage-merchant-apple-pay')->first()))
        {
            $permission->name = 'manage-merchant-apple-pay';
            $permission->display_name = 'Manage merchant apple pay';
            $permission->description = 'Manage merchant apple pay';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','view-monitoring')->first())) {
            $permission->name = 'view-monitoring';
            $permission->display_name = 'view-monitoring';
            $permission->description = 'view-monitoring';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','manage-reports')->first())) {
            $permission->name = 'manage-reports';
            $permission->display_name = 'manage-reports';
            $permission->description = 'manage-reports';
            $permission->save();
        }

        $permission = new Permission();
        if(is_null($permission->select()->where('name','view-reports')->first())) {
            $permission->name = 'view-reports';
            $permission->display_name = 'view-reports';
            $permission->description = 'view-reports';
            $permission->save();
        }
    }
}
