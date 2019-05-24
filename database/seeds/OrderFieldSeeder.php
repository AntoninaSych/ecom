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
        $field->field_key = 'merchant_website';
        $field->save();


        //setup Fields witch merchant can update with moderation of Business role
        $field = new OrderField();
        $field->table_name  = 'merchants';
        $field->field_key = 'mcc_id';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'personType';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_name';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_inn';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_birthday';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_email';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_retail_name';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_city';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_address';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_region';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_mail_index';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_is_director';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_fio';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_inn';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_birthday';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_phone';
        $field->save();


        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_email';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_retail_name';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_city';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_address';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_region';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_mail_index';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_fio';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_inn';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_birthday';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_phone';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_email';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_fio_contact';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_phone_contact';
        $field->save();


        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_email_contact';
        $field->save();


        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_phone';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_email';
        $field->save();


// Mechant Account
        $field = new OrderField();
        $field->table_name  = 'merchant_account';
        $field->field_key = 'mfo';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_account';
        $field->field_key = 'ed_rpo';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_account';
        $field->field_key = 'checking_account';
        $field->save();


        $field = new OrderField();
        $field->table_name  = 'merchant_account';
        $field->field_key = 'account_id';
        $field->save();



    }
}




