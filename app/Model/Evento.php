<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['museu_id', 'tema_id', 'evento_tipo_id', 'nome',
                            'inicio_evento', 'fim_evento', 'hora_inicio_evento',
                            'hora_fim_evento', 'local', 'latitude', 'longitude'
    ];

    public function tipo()
    {
        return $this->belongsTo('App\Model\EventoTipo', 'evento_tipo_id');
    }

    public function tema()
    {
        return $this->belongsTo('App\Model\Tema');
    }

    public function museu()
    {
        return $this->belongsTo('App\Model\Museu');
    }
}
