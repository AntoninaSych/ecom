<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Users extends BaseModel
{
    protected $table = 'users';

    public function roles_relation(): BelongsToMany
    {
        return $this->belongsToMany(Role::class,
            'role_user',
            'user_id',
            'role_id');
    }

}
