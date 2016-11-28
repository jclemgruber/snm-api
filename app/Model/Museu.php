<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Museu extends Model
{
    protected $fillable = ['nome', 'site', 'email', 'user_id',
                            'instituicao_tipo_id', 'fone1', 'fone2'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function instituicaoTipo()
    {
        return $this->belongsTo('App\Model\InstituicaoTipo');
    }

    public function enderecos()
    {
        return $this->hasMany('App\Model\MuseuEndereco');
    }

    public function eventos()
    {
        return $this->hasMany('App\Model\Evento');
    }
}
