<?php

use App\Models\RefOrderCheckStage;
use Illuminate\Database\Seeder;

class RefOrderCheckStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new  RefOrderCheckStage();
        $permission->name   = 'На проверке';
        $permission->save();

        $permission = new  RefOrderCheckStage();
        $permission->name   = 'Согласован';
        $permission->save();

        $permission = new  RefOrderCheckStage();
        $permission->name   = 'Не прошел проверку';
        $permission->save();
    }
}
