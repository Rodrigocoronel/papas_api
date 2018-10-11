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
    
    Route::post('/BotellaNueva','controladorBotellas@registrarBotella');             // Registrar nueva botella

    Route::post('/AlmacenNuevo','controladorAlmacenes@registrarAlmacen');
    
 });

 // Botellas
 Route::get('/Botella/{folio}','controladorBotellas@botellaPorFolio');                   // Encontrar Por Folio
 Route::get('/Botellas/{insumo}','controladorBotellas@botellaPorCodigoDeInsumo');        // Encontrar Por numero de insumo
 Route::get('/NombreBotellas/{desc}','controladorBotellas@botellasPorNombre');           // Encontrar Por descripcion
 Route::get('/Botellas','controladorBotellas@todasLasBotellas');                         // Listar todas

 //Almacenes
 Route::get('/Almacen/{id}','controladorAlmacenes@almacenPorId');
 Route::get('/Almacenes','controladorAlmacenes@todosLosAlmacenes');

 // Movimientos
 Route::get('/MovimientoNuevo/{datos}','controladorMovimientos@registrarMovimiento');    // Registrar nuevo movimiento
 Route::get('/Movimientos/{folio}','controladorMovimientos@movimientosPorFolio');        // Buscar movimientos de un folio especifico (botella)
 Route::get('/SalidasPorArea/{area}/{fecha}','controladorMovimientos@salidas');             // Reporte de salidas y traspasos por area y fecha

 // Todo
 Route::get('Historial/{folio}','Post@');