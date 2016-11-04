<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;
use App\Model\Tema;
use Carbon\Carbon;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temas = Tema::orderBy('fim_evento','desc')
                    ->get()
                    ->toArray();

        return $temas;
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required',
            'ativo' => 'required|boolean',
            'inicio_evento' => 'required|date_format:Y-m-d\TH:i:s.u\Z',
            'fim_evento' => 'required|date_format:Y-m-d\TH:i:s.u\Z|after:inicio_evento',
            'inicio_inscricoes' => 'required|date_format:Y-m-d\TH:i:s.u\Z',
            'fim_inscricoes' => 'required|date_format:Y-m-d\TH:i:s.u\Z|after:inicio_inscricoes'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        return Tema::create([
            'nome' => $request->nome,
            'ativo' => $request->ativo,
            'inicio_evento' => $request->inicio_evento,
            'fim_evento' => $request->fim_evento,
            'inicio_inscricoes' => $request->inicio_inscricoes,
            'fim_inscricoes' => $request->fim_inscricoes,
            'antes_inscricoes' => '',
            'apos_inscricoes' => ''
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
        return Tema::findOrFail($id);
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
}
