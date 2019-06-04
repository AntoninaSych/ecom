<?php


namespace App\Classes\Helpers;

use Illuminate\Support\Facades\Facade;

class OrderFieldHelper extends Facade
{

    public static function getLabel(string $fieldName): string
    {
        $fieldLabels = [
            'id' => 'ID',
            'merchant_id' => 'ID мерчанта',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'merchant_status' =>'Статус мерчанта',
            'user'=>'Пользователь',
            'compensation_type'=>'Тип компенсации',
            'compensation_term' =>'Время компенсации',
            'merchant_type'=>'Тип мерчанта',

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
            'ind_contact_name' => 'ФИО  контактного лица (физ)',
            'ind_contact_phone' => 'Телефон  контактного лица (физ)',
            'ind_contact_email' => 'Email  контактного лица (физ)',
            //Данные директора
            'ind_fio' => 'ФИО директора  (физ)',
            'ind_inn' => 'ИНН директора  (физ)',
            'ind_birthday' => 'Дата рождения директора (физ)',
            'ind_phone' => 'Телефон директора (физ)',
            'ind_email' => 'Email директора (физ)',
            //Торговець є платником податку на прибуток:
            'ind_main_rate' => 'по основной ставке  (физ)',
            'ind_single_tax_rate' => 'единого налога по ставке  (физ)',
///----------------Юридическое лицо--------/////
            //Данные юридической особы
            'ur_retail_name_ukr' => "Название  (юр)(укр)",
            'ur_retail_name_en' => "Название  (юр)(англ)",
            'ur_city' => 'Город  (юр)',
            'ur_address' => 'Адрес   (юр)',
            'ur_region' => 'Область (юр)',
            //Данные директора юридической особы
            'ur_fio' => 'ФИО директора (юр)',
            'ur_inn' => 'ИНН (юр)',
            'ur_birthday' => 'Дата рождения директора (юр)',
            'ur_phone' => 'Телефон директора (юр)',
            'ur_email' => 'Email директора (юр)',
            //Данные контактного лица
            'ur_contact_fio' => 'ФИО контактного лица (юр)',
            'ur_contact_phone' => 'Телефон контактного лица (юр)',
            'ur_contact_email' => 'Email контактного лица (юр)',
            //Фактична адреса ведення бізнесу:
            'ur_actual_business_address' => 'Адрес фактический ведения бизнеса (юр)',
            'ur_actual_business_city' => 'Город  фактический ведения бизнеса (юр)',
            'ur_actual_business_region' => 'Область фактическая ведения бизнеса (юр)',
            'ur_actual_business_index' => 'Индекс фактический ведения бизнеса (юр)',
            'ur_type' => 'тип (офіс, склад, інше) (юр)',
            'ur_data_controllers' => 'Данные о контроллеров юридического лица (юр)',
            //Дані бухгалтера (за наявністю)
            'ur_buh_fio' => 'ФИО бухгалтера (юр)',
            'ur_buh_phone' => 'Телефон бухгалтера (юр)',
            'ur_buh_email' => 'Email бухгалтера (юр)',
            //account
            'mfo'=>'МФО  (юр)',
            'ed_rpo'=>'ЕД РПО (юр)',
            'checking_account'=>'Расчетный счет (юр)',
            'account_id'=>'ID аккаунта (юр)'
        ];

        return $fieldLabels[$fieldName];
    }
}

