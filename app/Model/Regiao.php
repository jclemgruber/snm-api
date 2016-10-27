<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'regioes';
    protected $fillable = ['name'];

    public function ufs()
    {
    	return $this->hasMany('App\Model\Uf');
    }
}
