<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    /**
     * Um usuário só pode ser de 1 tipo (cliente ou admin)
     * 
     * @return BelongsTo
     */
    public function userType() {
        
        return $this->belongsTo(UserType::class);
    }

    /**
     * Um usuário pode ser um cliente
     * 
     * @return HasOne
     */
    public function client() {

        return $this->hasOne(Client::class);
    }
}
