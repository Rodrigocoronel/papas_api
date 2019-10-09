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
			}
			if(Factura::where('folio_factura','=',$factura['folio_factura'])->exists())
			{
				$impreso=1;
				$laFactura = Factura::where('folio_factura','=',$factura['folio_factura'])->first();

				$error=0;
				$factura=$laFactura;
				$noArticulos=0;
				$articulos=$laFactura->insumosProd;
				$impreso=$impreso;
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
					];
					$noArticulos = $noArticulos + $item['Cantidad'];
					if($impreso == 1) $articulo['max'] = 0;

					array_push($articulos, $articulo);
				}

				if(empty($factura) || empty($articulos))
				{
					$error = 2; // Archivo incorrecto
					return response()->json(['error' => $error]);
				}
			}

			if($impreso == 1) $noArticulos = 0;
			return response()->json([ 'error'       => $error,
									  'factura'     => $factura,
									  'noArticulos' => $noArticulos,
									  'articulos'   => $articulos,
									  'impreso'     => $impreso
			]);
		}
		else
		{
			// No hay archivo
			return response()->json(['error'=>'1']);
		}
	}

	public function generarEtiquetas(Request $data)
	{
		$user = $data->user();
		$datos = $data->input();
		$datos_botellas = $datos['botellas'];
		$datos_factura = $datos['factura'];

		$etiquetas=[];
		$registro=[];

		// Generar registro de factura
		if(!Factura::where('folio_factura','=',$datos_factura['folio_factura'])->exists())
		{
			$factura = Factura::create($datos_factura);

			foreach ($datos_botellas as $botella => $value) {
				$value['factura_id'] = $factura->id;
				$new = Insumos::create($value);
			}
		}
		else
		{
			$factura = Factura::where('folio_factura','=',$datos_factura['folio_factura'])->first();
		}

		// Generar carpeta de codigo QR
		$PNG_TEMP_DIR = storage_path()."/codigos/";
		if ( !file_exists($PNG_TEMP_DIR) ) 
			mkdir($PNG_TEMP_DIR);


		// separador 
		$div='!#';

		// Generar registro etiquetas
		foreach ($datos_botellas as $etiqueta) 
		{

			// Empresa que compra la factura.
			//
			// Debe de salir de la tabla de empresa una vez que el  > > > BLADIMIR < < < lo programe.
			//
			$factura['comprador'] = 'PAPAS & BEER';

			$etiqueta['factura_id']=$factura['id'];
			$etiqueta['fecha_compra']=$factura['fecha_compra'];
			$etiqueta['folio_factura']=$factura['folio_factura'];
			$etiqueta['comprador']=$factura['comprador'];
			$etiqueta['proveedor']=$factura['proveedor'];
			$etiqueta['almacen_id']=1;
			$cant = (int)($etiqueta['cantidad']);

			for($a=0; $a < $cant; $a++)
			{
				unset($etiqueta['id']);
				$registro = Botella::create($etiqueta);
				$mov[0] = [
					"almacen_id"=> 1,               // 1 - Almacen General
					'movimiento_id' => 1,           // 1 - Primer movimiento registrado como entrada
					'fecha'=> date('Y-m-d H:i:s'),
					'user' => $user->id,
				];
				$registro->movimientos()->attach($mov);
				$etiqueta['id'] = $registro['id'];
				
				array_push($etiquetas,$etiqueta);

				$valor= $etiqueta['id'].$div.
					$etiqueta['folio_factura'].$div.
					$etiqueta['fecha_compra'].$div.
					$etiqueta['insumo'].$div.
					$etiqueta['desc_insumo'].$div.
					$etiqueta['comprador'];

				$filename=$PNG_TEMP_DIR.$etiqueta['id'].'.png';
				//$imagenes[$x]=$filename;
				$matrixPointSize = 10;
				$errorCorrectionLevel = 'L';
				QRcode::png($valor, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
			}
		}
		

		// Generar pdf con etiquetas
		$pdf = PDF::loadView('pdf.etiqueta', [ 'etiqueta' => $etiquetas]);
		$tamanioEtiqueta = array(0,0,216,108);
		$pdf->setPaper($tamanioEtiqueta);
		$pdf->output();

		// Guardar pdf en servidor
		$filename = "temp_pdf_file";
		$archivo_generado = $pdf->output();
		file_put_contents($PNG_TEMP_DIR.$filename.".pdf", $archivo_generado);

		return response()->json($filename);
	}

	public function descargarEtiquetas($archivo)
	{
		$el_pdf = storage_path().'/codigos/'.$archivo.'.pdf';
		return response()->download($el_pdf);
	}

	public function eliminarEtiqueta(Request $data)
	{
		$user = $data->user();
		$datos = $data->input();
		$id = $datos['botella'];
		$motivo = $datos['motivo'];

		$registro = Botella::where('id','=',$id)->first();

		$mov[0]=[
                'almacen_id'=> $registro['almacen_id'],
                'movimiento_id' => 5,
                'fecha'=> date('Y-m-d H:i:s'),
                'user' => $user->id,
        ];
        $registro->movimientos()->attach($mov);
        $registro->transito = 5;
        $registro->motivo = $motivo;
        $registro->save();

		$registrado = true;
		return response()->json(['registrado' => $registrado, 'registro' => $registro]);
	}

}