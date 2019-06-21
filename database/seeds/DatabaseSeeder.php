<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /*$this->call(PermissionTableSeeder::class);
        $this->call(MccCodesSeeder::class);
        $this->call(OrderFieldSeeder::class);
        $this->call(RefOrderStatusSeeder::class);
        $this->call(CmsTableSeeder::class);
        $this->call(UserRole::class);
        $this->call(RefFeeTypeSeeder::class);
        $this->call(LimitTypesSeeder::class);*/
        $this->call(RefFeeTypeSeeder::class);
        $this->call(LimitTypesSeeder::class);
        $this->call(CmsTableSeeder::class);
        //$this->call(MccCodesLiqpaySeeder::class);
    }
}
