<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $fillable = ['nome','inicio_inscricoes','fim_inscricoes',
                            'inicio_evento','fim_evento','antes_inscricoes',
                            'apos_inscricoes'
    ];
    
}
