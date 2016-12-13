<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'cors'], function(){

    Route::post('token',    'AuthenticateController@authenticate');
    Route::post('register', 'Auth\RegisterController@registerApi');

    Route::group(['middleware' => 'jwt.auth'], function(){

        Route::get('/user', function(Request $request) {
        	return $request->user();
        });

        Route::get('/cidades/list','CidadeController@list');
        Route::resource('cidades','CidadeController');

        Route::resource('temas','TemaController');

        Route::resource('museus','MuseuController');

        Route::get('/eventos/museu/{id}', 'EventoController@list');
        Route::resource('eventos','EventoController');

        Route::get('/instituicao/tipos',    'InstituicaoTipoController@list');
        Route::get('/evento/tipos',         'EventoTipoController@list');

    });
});
