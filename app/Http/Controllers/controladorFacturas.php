<?php

namespace App\Http\Controllers;
include storage_path()."/librerias/phpqrcode/qrlib.php";
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;
use PDF;

use App\Factura;
use App\Botella;
use App\Insumos;
use App\Movimiento;
use SimpleXMLElement;
use DomDocument;
use QRcode;
use DB;

use App\EtiquetaReimpresa;

class controladorFacturas extends Controller
{
	public function cargarFactura(Request $datos)
	{
		$error = 0; // Archivo OK
		$impreso = 0; // Revisar si ya se imprimio
		$archivo = $datos->file('archivo');
		if(!empty($archivo))
		{
			$xml = simplexml_load_file($archivo);
			$ns = $xml->getNamespaces(true);
			$xml->registerXPathNamespace('c', $ns['cfdi']);

			$factura=[];
			foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante)
			{ 
				$factura['folio_factura']=$cfdiComprobante['Folio'].'';
				$temp=strtotime($cfdiComprobante['Fecha'].'');
				$factura['fecha_compra']= date('Y-m-d',$temp);

			}
			foreach ($xml->xpath('//cfdi:Receptor') as $cfdiReceptor)
			{ 
				$factura['comprador']=$cfdiReceptor['Nombre'].'';
				
			}
			foreach ($xml->xpath('//cfdi:Emisor') as $cfdiEmisor)
			{ 
				$factura['proveedor']=$cfdiEmisor['Nombre'].'';
				$factura['rfc_proveedor']=$cfdiEmisor['Rfc'].'';
			}
			if(Factura::where('folio_factura','=',$factura['folio_factura'])->where('rfc_proveedor','=',$factura['rfc_proveedor'])->exists())
			{
				$laFactura = Factura::where('folio_factura','=',$factura['folio_factura'])->where('rfc_proveedor','=',$factura['rfc_proveedor'])->first();

				$error=0;
				$factura=$laFactura;
				$noArticulos=0;
				$articulos=$laFactura->insumosProd;
				$facturaGuardada = true;
			}
			else
			{
				$articulos=[];
				$noArticulos=0;
				$items=$xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto');
				foreach($items as $item)
				{
					$articulo=[
						'insumo'      => '',
						'desc_insumo' => '',
						'referencia'  => $item['Descripcion'].'',
						'cantidad'    => (int)($item['Cantidad']).'',
						'max' 		  => (int)($item['Cantidad']).'',
						'producto_id' => '',
						'insumoSelect' => null,
						'impreso' => 0,
					];

					array_push($articulos, $articulo);
				}

				if(empty($factura) || empty($articulos))
				{
					$error = 2; // Archivo incorrecto
					return response()->json(['error' => $error]);
				}

				$facturaGuardada = false;
			}

			return response()->json([ 'error'       => $error,
									  'factura'     => $factura,
									  'noArticulos' => $noArticulos,
									  'articulos'   => $articulos,
									  'facturaGuardada' => $facturaGuardada,
			]);
		}
		else
		{
			// No hay archivo
			return response()->json(['error'=>'1']);
		}
	}

	public function guardarFactura(Request $data)
	{
		$user = $data->user();
		$datos = $data->input();

		$datos_botellas = $datos['botellas'];
		$datos_factura = $datos['factura'];

		// Generar registro de factura
		if(!Factura::where('folio_factura','=',$datos_factura['folio_factura'])->where('rfc_proveedor','=',$datos_factura['rfc_proveedor'])->exists())
		{
			$factura = Factura::create($datos_factura);

			foreach ($datos_botellas as $botella => $value) {
				$value['factura_id'] = $factura->id;
				$new = Insumos::create($value);
			}

			$output = true;
			$fac_out = $factura->id;
		}else{
			$output = false;
			$fac_out = 0;
		}

		return response()->json(['error'=> $output , 'id' => $fac_out ]);
	}

	public function generarEtiquetas(Request $request){

		$incoming = $request->input();
		$user = $request->user();

		$factura = $incoming['factura'];
		$producto = $incoming['producto_id'];

		$data = Insumos::where('factura_id','=',$factura)->where('producto_id','=',$producto)->get();

		// Generar carpeta de codigo QR
		$PNG_TEMP_DIR = storage_path()."/codigos/";
		if ( !file_exists($PNG_TEMP_DIR) ) 
			mkdir($PNG_TEMP_DIR);


		// separador 
		$div='!#';

		// Generar registro etiquetas
		foreach ($data as $insumo => $insumoValue) 
		{

			for($a=0; $a < $insumoValue->cantidad; $a++)
			{

				$botella = [
					'factura_id' => $insumoValue->factura_id,
					'insumo' => $insumoValue->productos_rel->insumo,
					'desc_insumo' => $insumoValue->productos_rel->desc_insumo,
					'fecha_compra' => $insumoValue->factura_rel->fecha_compra,
					'almacen_id' => 1,
					'transito' => 0 ,
				];

				$registro = Botella::create($botella);

				$mov[0] = [
					"almacen_id"=> 1,               // 1 - Almacen General
					'movimiento_id' => 1,           // 1 - Primer movimiento registrado como entrada
					'fecha'=> date('Y-m-d H:i:s'),
					'user' => $user->id,
				];

				//registrar el primer movimiento de entrada
				$registro->movimientos()->attach($mov);

				//folio de la factura
				$etiqueta['id'] = $registro['id'];

				//contenido del qr
				$valor= $registro->id.$div.
					$insumoValue->factura_rel->folio_factura.$div.
					$insumoValue->factura_rel->fecha_compra.$div.
					$insumoValue->producto_id.$div.
					$insumoValue->productos_rel->desc_insumo.$div.
					$insumoValue->factura_rel->comprador;


				//generar el codigo qr
				$filename=$PNG_TEMP_DIR.$etiqueta['id'].'.png';
				$matrixPointSize = 10;
				$errorCorrectionLevel = 'L';
				QRcode::png($valor, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
			}
		}
	}

	public function descargarEtiquetas($factura,$insumo,$producto)
	{
		ini_set('max_execution_time', 600);
		ini_set("memory_limit",-1);


		$insumirri = Insumos::where('factura_id','=',$factura)->where('producto_id','=',$producto)->first();

		$insumirri->impreso = 1;
		$insumirri->fecha_impreso = date('Y-m-d H:i:s');
		$insumirri->save();

		//Sacar las botellas de la factura
		$data = Botella::where('factura_id','=',$factura)->where('insumo','=',$insumo)->get();


		// Generar pdf con etiquetas
		$pdf = PDF::loadView('pdf.etiqueta', [ 'etiqueta' => $data ]);
		$tamanioEtiqueta = array(0,0,216,108);
		$pdf->setPaper($tamanioEtiqueta);
		$pdf->output();

		return $pdf->stream('botellas.pdf');
	}

	public function eliminarEtiqueta(Request $data)
	{

		$user = $data->user();
		$datos = $data->input();
		$id = $datos['botella'];
		$motivo = $datos['motivo'];

		$registrado = false;

		$registro = Botella::where('id','=',$id)->first();

		if($registro->transito != 5){
			$mov[0]=[
	                'almacen_id'=> $registro['almacen_id'],
	                'movimiento_id' => 5,
	                'fecha'=> date('Y-m-d H:i:s'),
	                'user' => $user->id,
	        ];
	        $registro->movimientos()->attach($mov);
	        $registro->transito = 5;
	        $registro->motivo = $motivo;
	        $registro->user_delete = $user->id;
	        $registro->save();

			$registrado = true;
		}

		$output = $this->build_botella($registro);

		return response()->json(['registrado' => $registrado, 'botella' => $output ]);
	}

	public function new_bottle(Request $request)
    {

    	ini_set('max_execution_time', 600);
		ini_set("memory_limit",-1);

        $data = $request->input();
        $user = $request->user();

		$botella_antigua = Botella::find($data['botella']);

		$botella = [
			'factura_id' => $botella_antigua->factura_id,
			'insumo' => $botella_antigua->insumo,
			'desc_insumo' => $botella_antigua->desc_insumo,
			'fecha_compra' => $botella_antigua->fecha_compra,
			'almacen_id' => 1,
			'transito' => 0 ,
		];

		$new = Botella::create($botella);

		$mov[0] = [
			"almacen_id"=> 1,               // 1 - Almacen General
			'movimiento_id' => 1,           // 1 - Primer movimiento registrado como entrada
			'fecha'=> date('Y-m-d H:i:s'),
			'user' => $user->id,
		];

		//registrar el primer movimiento de entrada
		$new->movimientos()->attach($mov);

		//registro de log en que id se cambio la botella

		$logs = EtiquetaReimpresa::create([
			'destruida_id' => $botella_antigua->id,
        	'nueva_id' => $new->id,
        	'user_id' => $user->id
		]);

		$to_pdf = Botella::where('id','=',$new->id)->get();

		// separador 
		$div='!#';

		//contenido del qr
		$valor= $new->id.$div.
		$new->factura->folio_factura.$div.
		$new->factura->fecha_compra.$div.
		'0'.$div.
		$new->desc_insumo.$div.
		$new->factura->comprador;

		$PNG_TEMP_DIR = storage_path()."/codigos/";

		//generar el codigo qr
		$filename=$PNG_TEMP_DIR.$new->id.'.png';
		$matrixPointSize = 10;
		$errorCorrectionLevel = 'L';
		QRcode::png($valor, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

		// Generar pdf con etiquetas
		$pdf = PDF::loadView('pdf.etiqueta', [ 'etiqueta' => $to_pdf ]);
		$tamanioEtiqueta = array(0,0,216,108);
		$pdf->setPaper($tamanioEtiqueta);
		$pdf->output();

		return $pdf->stream('botellas.pdf');

    }

	 public function build_botella($item)
    {
        return [
            'id' => $item->id,
            'insumo' => $item->insumo,
            'desc_insumo' => $item->desc_insumo,
            'fecha_compra' => $item->fecha_compra,
            'transito' => $item->transito,
            'almacen' => $item->almacen,
            'motivo' => $item->motivo,
            'user_delete' => $item->usr_delete? $item->usr_delete->name : '',
            'mov' => $item->movimientoArray,
        ]; 
    }

	/**
     * Get all the data;
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output = [];

        $lista = Factura::lista([
            'folio_factura'    => isset($_GET["folio_factura"]) ? $_GET["folio_factura"] : null,
            'proveedor'    => isset($_GET["proveedor"]) ? $_GET["proveedor"] : null,
            'rfc'    => isset($_GET["rfc"]) ? $_GET["rfc"] : null,
            'fecha_compra'  => isset($_GET["fecha_compra"]) ? $_GET["fecha_compra"] : null,
            'fecha1'  => isset($_GET["fecha1"]) ? $_GET["fecha1"] : null,
            'fecha2'  => isset($_GET["fecha2"]) ? $_GET["fecha2"] : null,
            'take'     => isset($_GET["take"]) ? $_GET["take"] : null,                     
            'skip'    => isset($_GET["skip"]) ? $_GET["skip"] : null,
        ])->get();

        $conteo = Factura::conteo([
            'folio_factura'    => isset($_GET["folio_factura"]) ? $_GET["folio_factura"] : null,
            'proveedor'    => isset($_GET["proveedor"]) ? $_GET["proveedor"] : null,
            'rfc'    => isset($_GET["rfc"]) ? $_GET["rfc"] : null,
            'fecha1'  => isset($_GET["fecha1"]) ? $_GET["fecha1"] : null,
            'fecha2'  => isset($_GET["fecha2"]) ? $_GET["fecha2"] : null,
            'fecha_compra'  => isset($_GET["fecha_compra"]) ? $_GET["fecha_compra"] : null,
        ])->get();

        $output = $lista->transform(function($item){
            return $this->build_factura($item);
        });

        return response()->json(['datos'=>$output,'total'=> count($conteo)]);
    }

    public function build_factura($item)
    {
    	return [
    		'id' => $item->id,
    		'folio_factura' => $item->folio_factura,
    		'proveedor' => $item->proveedor,
    		'fecha_compra' => $item->fecha_compra,
    		'rfc_proveedor' => $item->rfc_proveedor
    	];
    }

    public function facturas_insumos($factura)
    {
    	$output = [];

    	$data = Factura::find($factura);

    	return response()->json($data->insumosProd);
    	
    }

    public function etiquetas_eliminadas()
    {
    	$take = isset($_GET["take"]) ? $_GET["take"] : null;                    
        $skip = isset($_GET["skip"]) ? $_GET["skip"] : null;

        $fecha1 = isset($_GET["fecha1"]) ? $_GET["fecha1"] : null;                    
        $fecha2 = isset($_GET["fecha2"]) ? $_GET["fecha2"] : null; 

        $data= DB::table('etiquetas_reimpresas')
        	->select('etiquetas_reimpresas.*','botella.desc_insumo','users.name')
        	->orderby('created_at','desc')
        	->join('botella','etiquetas_reimpresas.destruida_id','botella.id')
        	->join('users','etiquetas_reimpresas.user_id','users.id')
        	->where(function($query) use($fecha1,$fecha2) {

	     	if($fecha1 != '' && $fecha2 != '')
	        	$query->whereBetween('etiquetas_reimpresas.created_at',[$fecha1.' 00:00:00' , $fecha2.' 23:59:59']);

	        if($fecha1 != '' && $fecha2 == '')
	        	$query->whereBetween('etiquetas_reimpresas.created_at',[$fecha1.' 00:00:00' , $fecha1.' 23:59:59']);

	     })->take($take)->skip($skip)->get();

    	// $data = EtiquetaReimpresa::orderby('created_at','desc')->take($take)->skip($skip)->get();

    	$total = DB::table('etiquetas_reimpresas')
    		->select(DB::raw('count(id) as total'))
    		->where(function($query) use($fecha1,$fecha2) {

	     	if($fecha1 != '' && $fecha2 != '')
	        	$query->whereBetween('etiquetas_reimpresas.created_at',[$fecha1.' 00:00:00' , $fecha2.' 23:59:59']);

	        if($fecha1 != '' && $fecha2 == '')
	        	$query->whereBetween('etiquetas_reimpresas.created_at',[$fecha1.' 00:00:00' , $fecha1.' 23:59:59']);

	    })->get();

    	$output = $data->transform(function($item){
    		return $this->build_etiqueta_eliminada($item);
    	});

    	return response()->json([ 
    		'datos' => $output ,
    		'total' => $total
    	]);
    }

    public function build_etiqueta_eliminada($item)
    {
    	return [
    		'desc_insumo' => $item->desc_insumo,
    		'destruida_id' => $item->destruida_id,
    		'nueva_id' => $item->nueva_id,
    		'fecha' => $item->created_at  ,
    		'usuario' => $item->name
    	];
    }

    public function reporteEtiquetasEliminadas()
    {
    	$fecha1 = isset($_GET["fecha1"]) ? $_GET["fecha1"] : null;                    
        $fecha2 = isset($_GET["fecha2"]) ? $_GET["fecha2"] : null; 

        $data= DB::table('etiquetas_reimpresas')
        	->select('etiquetas_reimpresas.*','botella.desc_insumo','users.name','botella.motivo')
        	->orderby('created_at','desc')
        	->join('botella','etiquetas_reimpresas.destruida_id','botella.id')
        	->join('users','etiquetas_reimpresas.user_id','users.id')
        	->where(function($query) use($fecha1,$fecha2) {

	     	if($fecha1 != '' && $fecha2 != '')
	        	$query->whereBetween('etiquetas_reimpresas.created_at',[$fecha1.' 00:00:00' , $fecha2.' 23:59:59']);

	        if($fecha1 != '' && $fecha2 == '')
	        	$query->whereBetween('etiquetas_reimpresas.created_at',[$fecha1.' 00:00:00' , $fecha1.' 23:59:59']);

	     })->get();

        $pdf = PDF::loadView('pdf.Et_reimpresa', ['fecha1'=>$fecha1, 'fecha2'=>$fecha2, 'data' => $data] );
        $pdf->setPaper('letter');
        $pdf->output();


        return $pdf->stream("reimpresas.pdf");

    }

    public function reporte_impresas($fecha1){

    	$data = [];

    	 $fecha2 = isset($_GET["fecha2"]) ? $_GET["fecha2"] : ''; 

    	if($fecha1 != '' && $fecha2 != ''){

	    	$data = Factura::whereBetween('created_at' , [ $fecha1.' 00:00:00' , $fecha2.' 23:59:00'])->get();
    	}

    	if($fecha1 != '' && $fecha2 == ''){

    		$data = Factura::whereBetween('created_at',[ $fecha1.' 00:00:00' , $fecha1.' 23:59:59'])->get();
    	}

    	$kek = [];

    	foreach ($data as $key => $value) {

    		// $temp = Botella::select('min(id) as lel',' max(id) as lul')->where('factura_id','=',$value->id)->get();

    		$temp = DB::select("SELECT  min(botella.id) as minimo,
    			max(botella.id) as maximo, 
    			facturas.folio_factura as folio_factura, 
    			botella.insumo, facturas.created_at as fecha_impreso,
    			facturas.fecha_compra as fecha_compra,
    			facturas.proveedor as proveedor,
    			count(botella.id) as cantidad

    			FROM botella

    			join facturas on facturas.id = botella.factura_id

        		where botella.factura_id = ?

        		group by insumo

        		", [$value->id]);

    		foreach ($temp as $asd => $valueTem) {
    			array_push($kek, $valueTem);
    		}

    		
    	}

    	$pdf = PDF::loadView('pdf.facturaimpresa', ['fecha1'=>$fecha1, 'fecha2'=>$fecha2, 'data' => $kek] );
        $pdf->setPaper('letter');
        $pdf->output();


        return $pdf->stream("impresas.pdf");
    	return response()->json( $kek );
    }

}