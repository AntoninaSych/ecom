<?php

use Illuminate\Database\Seeder;

class RefFeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new \App\Models\RefFeeType();
        $status->name   = 'комиссия с мерчента';
        $status->save();
        $status = new \App\Models\RefFeeType();
        $status->name   = 'комиссия с клиента';
        $status->save();
    }
}
