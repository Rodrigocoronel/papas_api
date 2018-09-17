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

Route::middleware(['auth:api'])->group(function () {

    Route::get('/user', function (Request $request) {
    	return $request->user();
    });

    Route::post('/logout', function(Request $request){
    	$request->user()->token()->revoke();
    	return response()->json([]);
    });

	Route::get('/users/{id}' , 'UsersController@show');
    Route::post('/usuario','UsersController@registro');
    Route::post('/usuario/{id}','UsersController@update');
	Route::post('/usuario_validar' , 'UsersController@validacion');
	Route::get('/usuario/busqueda', 'UsersController@busqueda');
	Route::get('/usuario/conteo', 'UsersController@conteo');
	Route::put('/password/{id}','UsersController@changePassword');

 });

 Route::get('/Botellas/{id}','controladorBotellas@todasLasBotellas'); 

// no auth required

