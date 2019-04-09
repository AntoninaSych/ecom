<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
//    protected $fillable = [
//        'task_complete_allowed',
//        'task_assign_allowed',
//        'lead_complete_allowed',
//        'lead_assign_allowed'
//    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
