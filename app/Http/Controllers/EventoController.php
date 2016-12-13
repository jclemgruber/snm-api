<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use JWTAuth;
use App\Model\Evento;
use App\Model\Museu;

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
        //
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
}
