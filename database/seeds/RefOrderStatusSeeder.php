<?php

use App\Models\RefOrderStatus;
use Illuminate\Database\Seeder;

class RefOrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new   RefOrderStatus();
        $status->name   = 'Новый';
        $status->save();
        $status = new   RefOrderStatus();
        $status->name   = 'На тестировании';
        $status->save();
        $status = new   RefOrderStatus();
        $status->name   = 'Активный';
        $status->save();
        $status = new   RefOrderStatus();
        $status->name   = 'Заблокирован';
        $status->save();

    }
}
