<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\InstituicaoTipo;

class InstituicaoTipoController extends Controller
{
    public function list()
    {
        $lista = [];
        $tipos = InstituicaoTipo::pluck('nome', 'id');
        foreach($tipos as $key=>$value){
            $lista[] = [
                'label' => $value,
                'value' => $key
            ];
        }
        return $lista;
    }
}
