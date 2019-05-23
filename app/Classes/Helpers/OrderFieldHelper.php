<?php


namespace App\Classes\Helpers;

use Illuminate\Support\Facades\Facade;

class OrderFieldHelper extends Facade
{

    public static function getLabel(string $fieldName): string
    {
        $fieldLabels = [];

        $fieldLabels['merchant_website'] = 'Сайт';
        $fieldLabels['mcc_id'] = 'MCC код';
        $fieldLabels['personType'] = 'Тип мерчанта';
        $fieldLabels['ind_contact_name'] = 'Имя контактного лица';
        $fieldLabels['ind_contact_inn'] = 'ИНН контактного лица';
        $fieldLabels['ind_contact_birthday'] = 'Дата рождения контактного лица';
        $fieldLabels['ind_contact_phone'] = 'Телефон контактного лица';
        $fieldLabels['ind_contact_email'] = 'Email контактного лица';
        $fieldLabels['ind_contact_retail_name'] = 'Название юр. особы';
        $fieldLabels['ind_contact_city'] = 'Город контактного лица';
        $fieldLabels['ind_contact_address'] = 'Адрес контактного лица';
        $fieldLabels['ind_contact_region'] = 'Область контактного лица';
        $fieldLabels['ind_contact_mail_index'] = 'Индекс контактного лица';
        $fieldLabels['ind_is_director'] = 'Физ.лицо является директором';
        $fieldLabels['ind_inn'] = 'ИНН директора физ лица';
        $fieldLabels['ind_fio'] = 'ФИО директора физ лица';
        $fieldLabels['ind_birthday'] = 'Дата рождения директора физ лица';
        $fieldLabels['ind_phone'] = 'Телефон директора физ лица';
        $fieldLabels['ind_email'] = 'Email директора физ лица';
        $fieldLabels['ur_retail_name'] = 'Название юр лица';
        $fieldLabels['ur_city'] = 'Город юр лица';
        $fieldLabels['ur_region'] = 'Регион юр лица';
        $fieldLabels['ur_mail_index'] = 'Индекс юр лица';
        $fieldLabels['ur_fio'] = 'ФИО юр лица';
        $fieldLabels['ur_inn'] = 'ИНН юр лица';
        $fieldLabels['ur_birthday'] = 'Дата рождения юр лица';
        $fieldLabels['ur_phone'] = 'Телефон юр лица';
        $fieldLabels['ur_email'] = 'Email юр лица';
        $fieldLabels['ur_fio_contact'] = 'ФИО юр контактного лица';
        $fieldLabels['ur_phone_contact'] = 'Телефон юр  контактного лица';
        $fieldLabels['ur_email_contact'] = 'Email юр контактного лица';
        $fieldLabels['ur_address'] = 'Адрес юр лица';

        return $fieldLabels[$fieldName];
    }
}

