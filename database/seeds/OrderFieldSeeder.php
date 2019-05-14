<?php


use App\Models\OrderField;
use Illuminate\Database\Seeder;


class OrderFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //setup Fields witch merchant can update with moderation of Business role
        $field = new OrderField();
        $field->table_name  = 'merchants';
        $field->field_key = 'name';
        $field->save();


        //setup Fields witch merchant can update with moderation of Business role
        $field = new OrderField();
        $field->table_name  = 'merchants';
        $field->field_key = 'url';
        $field->save();
    }
}
