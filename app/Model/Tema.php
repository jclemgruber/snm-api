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

    public function getInicioInscricoesAttribute()
    {
        return Carbon::parse($this->attributes['inicio_inscricoes'])->format('d/m/Y');
    }

    public function getFimInscricoesAttribute()
    {
        return Carbon::parse($this->attributes['fim_inscricoes'])->format('d/m/Y');
    }

    public function getInicioEventoAttribute()
    {
        return Carbon::parse($this->attributes['inicio_evento'])->format('d/m/Y');
    }

    public function getFimEventoAttribute()
    {
        return Carbon::parse($this->attributes['fim_evento'])->format('d/m/Y');
    }

    public function getAtivoAttribute()
    {
        return $this->attributes['ativo'] === 1;
    }
}
