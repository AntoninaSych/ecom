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
        $permission->description  = 'View merchants information'; // optional
        $permission->save();
    }
}
