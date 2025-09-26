<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * A tabela cliente pode conter vários usuários
     * 
     * @return BelongsTo
     */
    public function user() {

        return $this->belongsTo(User::class);
    }

    /**
     * Um cliente pode ter vários agendamentos
     * 
     * @return HasMany
     */
    public function schedules() {

        return $this->hasMany(Schedule::class);
    }

    /**
     * Informa os campos que devem ser preenchidos ao enviar dados em 
     * massa para o banco de dados
     */
    protected $fillable = [
        'phone',
        'address',
        'city',
        'user_id'
    ];
}
