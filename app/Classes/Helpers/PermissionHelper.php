<?php


namespace App\Classes\Helpers;


use Illuminate\Support\Facades\Facade;

class PermissionHelper extends Facade
{
    const MANAGE_USERS = 'manage-users';
    const VIEW_PAYMENTS = 'view-payments';
    const ADD_USERS = 'add-user';
    const MERCHANT_VIEW = 'merchant-view';
    const PROCESS_LOG_VIEW = 'process-log-view';
    const MANAGE_MCC =  'manage-mcc';
    const MANAGE_MERCHANT=  'manage-merchant';
}