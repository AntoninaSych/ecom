<?php


namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;

class MccCodes extends BaseModel
{
    use SoftDeletes;
    protected $table = 'mcc_code';
    protected $with = ['merchants'];

    public function merchants()
    {
        return $this->belongsTo(Merchants::class, 'id','mcc_id');
    }
}