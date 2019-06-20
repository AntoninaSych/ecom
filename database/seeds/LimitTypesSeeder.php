<?php

use App\Models\RefLimitType;
use Illuminate\Database\Seeder;

class LimitTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limitType = new RefLimitType();
        $limitType->name   = 'Суточный';
        $limitType->save();
        $limitType = new  RefLimitType();
        $limitType->name   = 'За одну операцию';
        $limitType->save();
    }
}
