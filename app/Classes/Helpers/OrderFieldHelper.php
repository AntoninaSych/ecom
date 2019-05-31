<?php


namespace App\Classes\Helpers;

use Illuminate\Support\Facades\Facade;

class OrderFieldHelper extends Facade
{

    public static function getLabel(string $fieldName): string
    {
        $fieldLabels = [
///----------------Общее для физ и юр лиц--------/////
            'merchant_website' => 'Сайт',
            'mcc_id' => 'Mcc Код',
            'name_retail_point_ukr' => 'Название торговой точки(укр)',
            'name_retail_point_en' => 'Название торговой точки(англ)',
            'category_description' => 'Перечень категорий товаров и видов работ / услуг, продаваемых / выполняются / услуг',
            'personType' => 'Тип мерчанта',
            'cms_id' => 'CMS',

///----------------Физ  лицо--------/////
            ///Данные контактного лица
            'ind_contact_name' => 'ФИО',
            'ind_contact_phone' => 'Телефон',
            'ind_contact_email' => 'Email',
            //Данные директора
            'ind_fio' => 'ФИО',
            'ind_inn' => 'ИНН',
            'ind_birthday' => 'Дата рождения',
            'ind_phone' => 'Телефон',
            'ind_email' => 'Email',
            //Торговець є платником податку на прибуток:
            'ind_main_rate' => 'по основной ставке',
            'ind_single_tax_rate' => 'единого налога по ставке',
///----------------Юридическое лицо--------/////
            //Данные юридической особы
            'ur_retail_name_ukr' => "Название юр. особы (укр)",
            'ur_retail_name_en' => "Название юр. особы (англ)",
            'ur_city' => 'Город',
            'ur_address' => 'Адрес',
            'ur_region' => 'Область',
            //Данные директора юридической особы
            'ur_fio' => 'ФИО',
            'ur_inn' => 'ИНН',
            'ur_birthday' => 'Дата рождения',
            'ur_phone' => 'Телефон',
            'ur_email' => 'Email',
            //Данные контактного лица
            'ur_contact_fio' => 'ФИО',
            'ur_contact_phone' => 'Телефон',
            'ur_contact_email' => 'Email',
            //Фактична адреса ведення бізнесу:
            'ur_actual_business_address' => 'Адрес',
            'ur_actual_business_city' => 'Город',
            'ur_actual_business_region' => 'Область',
            'ur_actual_business_index' => 'Индекс ',
            'ur_type' => 'тип (офіс, склад, інше) ',
            'ur_data_controllers' => 'Данные о контроллеров юридического лица',
            //Дані бухгалтера (за наявністю)
            'ur_buh_fio' => 'ФИО',
            'ur_buh_phone' => 'Телефон',
            'ur_buh_email' => 'Email',
            //account
            'mfo'=>'МФО',
            'ed_rpo'=>'ed_rpo',
            'checking_account'=>'checking_account',
            'account_id'=>'account_id'
        ];

        return $fieldLabels[$fieldName];
    }
}

