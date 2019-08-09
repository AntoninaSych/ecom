<?php

namespace App\Models;


class MerchantStatus extends BaseModel
{
    protected $table = 'ref_merchant_statuses';

    const NEW_STATUS = 1;
    const TEST_STATUS = 2;
    const ACTIVE_STATUS = 3;
    const SUSPENDED = 4;
    const BLOCKED = 5;



}
