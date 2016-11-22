<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use JWTAuth;
use DB;
use App\Model\Museu;
use App\Model\MuseuEndereco;

class MuseuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lista os museus registrados para o usuário autenticado
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Usuário não encontrado'], 404);
        }

        return $user->museus()
                    ->with('InstituicaoTipo', 'Enderecos')
                    ->with('Enderecos.cidade', 'Enderecos.cidade.uf')
                    ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Usuário não encontrado'], 404);
        }

        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        DB::transaction(function ($request) use ($request, $user) {
            $museu = Museu::create([
                'nome'                  => $request->nome,
                'instituicao_tipo_id'   => $request->instituicao_tipo_id,
                'site'                  => $request->site,
                'email'                 => $request->email,
                'fone1'                 => $request->fone1,
                'fone2'                 => $request->fone2,
                'user_id'               => $user->id
            ]);

            $museuEnder = MuseuEndereco::create([
                'museu_id'          => $museu->id,
                'cep'               => $request->cep,
                'cidade_id'         => $request->cidade_id,
                'logradouro'        => $request->logradouro,
                'numero'            => $request->numero,
                'complemento'       => $request->complemento,
                'bairro'            => $request->bairro
            ]);
        });

        return 'Museu Cadastrado!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Museu::with('Enderecos')
                    ->with('Enderecos.cidade')
                    ->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Usuário não encontrado'], 404);
        }

        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        DB::transaction(function($request) use ($request, $id){
            $museu = Museu::findOrFail($id);
            $museu->nome                  = $request->nome;
            $museu->instituicao_tipo_id   = $request->instituicao_tipo_id;
            $museu->site                  = $request->site;
            $museu->email                 = $request->email;
            $museu->fone1                 = $request->fone1;
            $museu->fone2                 = $request->fone2;

            $museuEnd = $museu->enderecos()->first();
            $museuEnd->cep               = $request->cep;
            $museuEnd->cidade_id         = $request->cidade_id;
            $museuEnd->logradouro        = $request->logradouro;
            $museuEnd->numero            = $request->numero;
            $museuEnd->complemento       = $request->complemento;
            $museuEnd->bairro            = $request->bairro;

            $museu->save();
            $museuEnd->save();
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required',
            'email' => 'required|email',
            'fone1' => 'required',
            'instituicao_tipo_id' => 'required',
            'cep' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade_id' => 'required|numeric'
        ]);
    }
}
