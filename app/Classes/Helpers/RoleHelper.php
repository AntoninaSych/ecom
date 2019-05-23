<?php


namespace App\Classes\Helpers;


use Illuminate\Support\Facades\Facade;

class RoleHelper extends Facade
{
    const SECURITY = 'security';
    const BUSINESS = 'business';
    const FRAUD_MONITORING = 'fraud_monitoring';
    const DEVELOPER = 'developer';

}