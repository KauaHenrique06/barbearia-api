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

    /**
     * Indica os campos que devem ser preenchidos para o banco
     */
    protected $fillable = [
        'client_id',
        'start_date'
    ];

    /**
     * O $guarded indica variáveis que não são obrigatórias enviar de primeiro momento
     * nesse caso ela poderá ser alterada quando necessári
     */
    protected $guarded = [
        'end_date'
    ];
}
