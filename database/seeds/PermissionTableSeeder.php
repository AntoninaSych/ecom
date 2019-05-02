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
        $permission->display_name = 'View processing'; // optional
        $permission->description  = 'View payment processing'; // optional
        $permission->save();

        $permission = new Permission();
        $permission->name         = 'process-log-view';
        $permission->display_name = 'View processing'; // optional
        $permission->description  = 'View payment processing'; // optional
        $permission->save();
    }
}
