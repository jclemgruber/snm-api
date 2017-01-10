<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Evento extends Model
{
    protected $fillable = ['museu_id', 'tema_id', 'evento_tipo_id', 'descricao',
                            'inicio_evento', 'fim_evento', 'hora_inicio_evento',
                            'hora_fim_evento', 'local', 'latitude', 'longitude'
    ];

    protected $dates = ['inicio_evento', 'fim_evento'];

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

    public function getDateMask($value)
    {
        $mask = 'Y-m-d\TH:i:s.u\Z';
        if (preg_match("~^\d{4}-\d{2}-\d{2}$~", $value))
            $mask = 'Y-m-d';

        return $mask;
    }

    public function getInicioEventoAttribute()
    {
        return Carbon::parse($this->attributes['inicio_evento'])->format('Y-m-d');
    }

    public function setInicioEventoAttribute($value)
    {
        $this->attributes['inicio_evento'] = Carbon::createFromFormat($this->getDateMask($value),$value);
    }

    public function getFimEventoAttribute()
    {
        return Carbon::parse($this->attributes['fim_evento'])->format('Y-m-d');
    }

    public function setFimEventoAttribute($value)
    {
        $this->attributes['fim_evento'] = Carbon::createFromFormat($this->getDateMask($value),$value);
    }
}
