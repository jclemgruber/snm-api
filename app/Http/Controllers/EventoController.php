<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use JWTAuth;
use App\Model\Evento;
use App\Model\Museu;
use App\Model\Tema;
use Carbon\Carbon;

class EventoController extends Controller
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

        return $user->museus()->with('eventos')->whereHas('eventos.tema', function($query) {
            $query->where('ativo', 1);
        })->get();
    }

    public function list($id)
    {
        // Lista os museus registrados para o usuário autenticado
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Usuário não encontrado'], 404);
        }

        return $user->museus()
                    ->with('eventos')
                    ->with('eventos.tipo')
                    ->findOrFail($id);
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

        $tema = Tema::ativo()->get()->first();

        $hrIniCarbon = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z',$request->horario['from']);
        $hrFimCarbon = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z',$request->horario['to']);

        $hrIni = $request->horario['from'];
        $hrFim = $request->horario['to'];

        if ($hrIniCarbon && $hrFimCarbon){
            $hrIni = $hrIniCarbon->format('H:i');
            $hrFim = $hrFimCarbon->format('H:i');
        }

        return Evento::create([
            'descricao'             => $request->descricao,
            'evento_tipo_id'        => $request->evento_tipo_id,
            'no_endereco_do_museu'  => $request->no_endereco_do_museu,
            'local'                 => $request->no_endereco_do_museu ? '' : $request->local,
            'latitude'              => $request->no_endereco_do_museu ? '' : $request->latitude,
            'longitude'             => $request->no_endereco_do_museu ? '' : $request->longitude,
            'inicio_evento'         => $request->periodo['from'],
            'fim_evento'            => $request->periodo['to'],
            'hora_inicio_evento'    => $hrIni,
            'hora_fim_evento'       => $hrFim,
            'museu_id'              => $request->museu_id,
            'tema_id'               => $tema->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
        $validator = Validator::make($data, [
            'descricao' => 'required',
            'evento_tipo_id' => 'required|numeric',
            'no_endereco_do_museu' => 'required|boolean',
            'periodo.from' => 'required',
            'periodo.to' => 'required|after:periodo.from',
            'horario.from' => 'required',
            'horario.to' => 'required',
            'museu_id' => 'required'
        ]);

        $validator->after(function ($validator) use ($data) {
            $user = JWTAuth::parseToken()->authenticate();
            $museu = $user->museus()->find($data['museu_id']);
            if (!$museu) {
                $validator->errors()->add('museu_id','Você não possui permissão para inscrever esse Museu');
            }
        });

        return $validator;
    }
}
