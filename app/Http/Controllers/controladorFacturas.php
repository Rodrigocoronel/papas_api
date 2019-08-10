<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;
use PDF;

use App\Factura;
use SimpleXMLElement;
use DomDocument;


class controladorFacturas extends Controller
{
	public function cargarFactura(Request $datos)
	{
		$error = 0; // Archivo OK
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
				$factura['fecha_compra']=$cfdiComprobante['Fecha'].'';
			}
			foreach ($xml->xpath('//cfdi:Receptor') as $cfdiReceptor)
			{ 
				$factura['comprador']=$cfdiReceptor['Nombre'].'';
			} 

			$articulos=[];
			$items=$xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto');
			$indice=0;
			foreach($items as $item)
			{
				$articulo=[
					'insumo'=> $item['NoIdentificacion'].'',
					'desc_insumo'=> $item['Descripcion'].'',
					'cantidad'=> $item['Cantidad'].'',
				]; 
				array_push($articulos, $articulo);
			}

			if(empty($factura) || empty($articulos))
			{
				$error = 2; // Archivo incorrecto
				return response()->json(['error' => $error]);
			}

			$impreso = 0; // Revisar si ya se imprimio

			return response()->json(['error' => $error, 'factura' => $factura, 'articulos' => $articulos, 'impreso' => $impreso]);
		}
		else
		{
			// No hay archivo
			return response()->json(['error'=>'1']);
		}
	}
}