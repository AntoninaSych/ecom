<?php


use Illuminate\Database\Seeder;


class MccCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //setup Roles
        $code = new \App\Models\MccCodes();
        $code->code         = '0123';
        $code->name = 'name1';
        $code->status  = 1;
        $code->save();

        $code = new \App\Models\MccCodes();
        $code->code         = '4567';
        $code->name = 'name2';
        $code->status  = 0;
        $code->save();

        $code = new \App\Models\MccCodes();
        $code->code         = '8910';
        $code->name = 'name3';
        $code->status  = 1;
        $code->save();


    }
}
