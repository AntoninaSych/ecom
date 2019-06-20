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



        ///----------------Общее для физ и юр лиц--------/////

         $field = new OrderField();
        $field->table_name  = 'merchants';
        $field->field_key = 'merchant_website';
        $field->save();

         $field = new OrderField();
        $field->table_name  = 'merchants';
        $field->field_key = 'mcc_id';
        $field->save();

         $field = new OrderField();
        $field->table_name  = 'merchants';
        $field->field_key = 'cms_id';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'name_retail_point_ukr';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'name_retail_point_en';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'category_description';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'personType';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'cms_id';
        $field->save();

        /////----------------Физ  лицо--------/////
        ///Данные контактного лица
        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_name';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_email';
        $field->save();


        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_contact_phone';
        $field->save();

        //Данные директора

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
        //Торговець є платником податку на прибуток:
        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_main_rate';
        $field->save();


        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ind_single_tax_rate';
        $field->save();
/////----------------Юридическое лицо--------/////

//Данные юридической особы
        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_retail_name_ukr';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_retail_name_en';
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

//            //Данные директора юридической особы

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
//            //Данные контактного лица
        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_contact_fio';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_contact_phone';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_contact_email';
        $field->save();
//            //Фактична адреса ведення бізнесу:
        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_actual_business_address';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_actual_business_city';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_actual_business_region';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_actual_business_index';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_type';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_data_controllers';
        $field->save();

//            //Дані бухгалтера (за наявністю)
        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_buh_fio';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_buh_phone';
        $field->save();

        $field = new OrderField();
        $field->table_name  = 'merchant_info';
        $field->field_key = 'ur_buh_email';
        $field->save();

//// Mechant Account
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




