<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MuseuEndereco extends Model
{
    protected $fillable = ['museu_id', 'endereco_tipo_id', 'cidade_id',
                            'logradouro', 'numero', 'complemento', 'bairro',
                            'cep', 'latitude', 'longitude'
    ];

    public function enderecoTipo()
    {
        return $this->belongsTo('App\Model\EnderecoTipo');
    }

    public function cidade()
    {
        return $this->belongsTo('App\Model\Cidade');
    }
}
