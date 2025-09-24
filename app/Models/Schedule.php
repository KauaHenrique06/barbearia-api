<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * O agendamento só pode ser feito por 1 cliente
     * 
     * @return BelongsTo
     */
    public function client() {

        return $this->belongsTo(Client::class);
    }
}
