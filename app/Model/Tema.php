<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tema extends Model
{
    protected $fillable = ['nome', 'ativo', 'inicio_inscricoes','fim_inscricoes',
                            'inicio_evento','fim_evento','antes_inscricoes',
                            'apos_inscricoes'
    ];

    protected $dates = ['inicio_inscricoes', 'fim_inscricoes', 'inicio_evento', 'fim_evento'];

    public function getDateMask($value)
    {
        $mask = 'Y-m-d\TH:i:s.u\Z';
        if (preg_match("~^\d{4}-\d{2}-\d{2}$~", $value))
            $mask = 'Y-m-d';

        return $mask;
    }

    public function getInicioInscricoesAttribute()
    {
        return Carbon::parse($this->attributes['inicio_inscricoes'])->format('Y-m-d');
    }

    public function setInicioInscricoesAttribute($value)
    {
        $this->attributes['inicio_inscricoes'] = Carbon::createFromFormat($this->getDateMask($value),$value);
    }

    public function getFimInscricoesAttribute()
    {
        return Carbon::parse($this->attributes['fim_inscricoes'])->format('Y-m-d');
    }

    public function setFimInscricoesAttribute($value)
    {
        $this->attributes['fim_inscricoes'] = Carbon::createFromFormat($this->getDateMask($value),$value);
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

    public function getAtivoAttribute()
    {
        return $this->attributes['ativo'] === 1;
    }
}
