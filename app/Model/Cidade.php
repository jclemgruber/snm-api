<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $fillable = ['nome','uf_id'];

    public function uf()
    {
    	return $this->belongsTo('App\Model\Uf');
    }
}
