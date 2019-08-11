<?php

use Illuminate\Http\Request;

Route::middleware(['auth:api'])->group(function ()
{
	Route::get('/user', function (Request $request)
	{
	return $request->user();
	});

	Route::post('/logout', function(Request $request)
	{
		$request->user()->token()->revoke();
		return response()->json([]);
	});

	// Usuarios
	Route::post('/NuevoUsuario',                 'UsersController@registro');                     // Registrar un nuevo usuario
	Route::get( '/Usuarios',                     'UsersController@todosLosUsuarios');             // Reporte de usuarios
	Route::post('/Usuario',                      'UsersController@update');                       // Actualizar datos de un usuario
	Route::get('/user_by_id/{id}' ,              'UsersController@get_user_id');

	// Facturas
	Route::post('/CargarXml',                    'controladorFacturas@cargarFactura');            // Sube archivo xml para generar etiquetas
	Route::post('/GenerarEtiquetas',			 'controladorFacturas@imprimirEtiquetas');		  // Imprime etiquetas 

	// Botellas
	Route::post('/BotellaNueva',                 'controladorBotellas@registrarBotella');         // Registrar nueva botella
	Route::get( '/Botella/{folio}',              'controladorBotellas@botellaPorFolio');          // Encontrar Por Folio
	Route::get( '/Botellas/{insumo}',            'controladorBotellas@botellaPorCodigoDeInsumo'); // Encontrar Por numero de insumo
	Route::get( '/NombreBotellas/{desc}',        'controladorBotellas@botellasPorNombre');        // Encontrar Por descripcion
	Route::get( '/Botellas',                     'controladorBotellas@todasLasBotellas');         // Listar todas

	// Almacenes
	Route::post('/AlmacenNuevo',                 'controladorAlmacenes@registrarAlmacen');        // Registrar almacen
	Route::post('/CambiarEstado',                'controladorAlmacenes@cambiarEstado');           // Cambiar estado de almacen
	Route::get( '/Almacen/{id}',                 'controladorAlmacenes@almacenPorId');            // Buscar almacen
	Route::get( '/Almacenes',                    'controladorAlmacenes@todosLosAlmacenes');       // Mostrar todos los almacenes

	// Movimientos
	Route::post('/MovimientoNuevo',              'controladorMovimientos@registrarMovimiento');   // Registrar nuevo movimiento
	Route::get( '/Movimientos/{folio}',          'controladorMovimientos@movimientosPorFolio');   // Buscar movimientos de un folio especifico
	Route::get( '/ReporteDeMovimientos/{fecha?}','controladorMovimientos@reportes');              // Reportes de salidas y traspasos
	Route::get( '/Inventario/{area}',			 'controladorMovimientos@inventarioPorArea');	  // Inventario de botellas por area

	//traspasos
	Route::post('/nuevo_traspaso', 'TraspasosController@create');
	Route::get('/last_traspaso', 'TraspasosController@lastRecord');
});
    
Route::post('/logincard','UsersController@login');   											 // Busqueda de numero de tarjeta para login con tarjeta RFID
Route::get('/reporteDeTraspaso/{traspaso}','controladorMovimientos@generarReporteDeTraspaso'); 			 // Pfd para reporte de traspasos
//Route::get('/reporteDeBusqueda','controladorMovimientos@imprimirReporteDeBusqueda'); 			 // Pfd para reporte de traspasos
Route::get('/reporte_de_busqueda','controladorMovimientos@imprimirReporteDeBusqueda'); 			 // Pfd para reporte de busquedas
Route::get( '/PdfInventario/{area}/{desglosar}','controladorMovimientos@inventarioPorAreaPDF');	 // Inventario de botellas por area