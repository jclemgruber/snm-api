<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['museu_id', 'evento_tipo_id', 'nome',
                            'inicio_evento', 'fim_evento', 'hora_inicio_evento',
                            'hora_fim_evento', 'local', 'latitude', 'longitude'
    ];

    public function tipo()
    {
        return $this->belongsTo('App/Model/EventoTipo');
    }
}
