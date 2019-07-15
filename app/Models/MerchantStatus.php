<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantStatus extends BaseModel
{
    protected $table = 'ref_merchant_statuses';

    const NEW_STATUS = 1;
    const TEST_STATUS = 2;
    const ACTIVE_STATUS = 3;
}
