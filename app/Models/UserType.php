<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    /**
     * Um tipo de usuário pode pertencer a vários clientes
     * 
     * @return HasMany
     */
    public function users() {

        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'type'
    ];
}
