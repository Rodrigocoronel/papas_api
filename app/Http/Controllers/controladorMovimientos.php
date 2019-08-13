<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;
use PDF;

use App\Movimiento;
use App\Botella;
use App\Traspaso;
use App\User;
use App\Almacen;

class controladorMovimientos extends Controller
{
    public function registrarMovimiento(Request $datos){
        
        $user = $datos->user();
        $data = $datos->input();
        $dato = [];
        $ubicacion = [];
        
        $registrado = false;
        if(Botella::where('folio','=',$data['folio'])->exists())
        {
            $registro = Botella::where('folio','=',$data['folio'])->first();

            switch($data['movimiento_id'])
            {
                case "1": // Entrada - El producto debe estar en transito = 0 (en transito)
                    if($registro->transito == '1' || $registro->transito == '6')
                    {
                        $mov[0]=[
                            'almacen_id'=> $data['almacen_id'],
                            'movimiento_id' => $data['movimiento_id'],
                            'fecha'=> date('Y-m-d H:i:s'),
                            'user' => $user->id,
                        ];
                        $registro->movimientos()->attach($mov);

                        $registro->almacen_id = $data['almacen_id'];
                        $registro->transito = 0;
                        $registro->save();
            
                        $registrado = true;
                        
                        $dato=[
                            'folio' => $data['folio'],
                            'movimiento_id' => $data['movimiento_id'],
                            'desc_insumo' => $registro['desc_insumo'],
                        ];
                    }
                break;
                case "5": // Baja - Almacen del que sale debe ser igual a Almacen_actual
                    // *** Hacer que el articulo no se pueda regresar ***
                    
                    $admin_user = User::where('tarjeta','=',$data['tarjeta'])->first();

                    if(!empty($admin_user)){
                        if($admin_user->tipo == 3){
                            if( $registro->almacen_id == $data['almacen_id'] ){
                                $mov[0]=[
                                    'almacen_id'=> $data['almacen_id'],
                                    'movimiento_id' => $data['movimiento_id'],
                                    'fecha'=> date('Y-m-d H:i:s'),
                                    'user' => $user->id,
                                ];
                                $registro->movimientos()->attach($mov);
                                
                                $data['transito'] = 5;                                
                                $registro->almacen_id = $data['almacen_id'];
                                $registro->transito = $data['transito'];
                                if($data['motivo'] == '1'){
                                    $motivo = 'Quebrada';
                                }else if($data['motivo'] == '2'){
                                    $motivo = 'En mal estado';
                                }else{
                                    $motivo = $data['motivo'];
                                }
                                $registro->motivo = $motivo;
                                $registro->save();

                                $registrado = true;
                                $dato=[
                                    'folio' =>$data['folio'],
                                    'movimiento_id' => $data['movimiento_id'],
                                    'desc_insumo' => $registro['desc_insumo'],
                                ];
                            }
                        }
                    }
                   
                    break;
                case "4": // Venta 
                    if( $registro->almacen_id == $data['almacen_id'] && $registro->transito == '0' && $registro->almacen_id > 2)
                    {
                        $mov[0]=[
                            'almacen_id'=> $data['almacen_id'],
                            'movimiento_id' => $data['movimiento_id'],
                            'fecha'=> date('Y-m-d H:i:s'),
                            'user' => $user->id,
                        ];
                        $registro->movimientos()->attach($mov);
                        
                        $data['transito'] = 4;                        
                        $registro->almacen_id = $data['almacen_id'];
                        $registro->transito = $data['transito'];
                        $registro->save();

                        $registrado = true;
                        $dato=[
                            'folio' => $data['folio'],
                            'movimiento_id' => $data['movimiento_id'],
                            'desc_insumo' => $registro['desc_insumo'],
                        ];
                    }
                    break; 
                case "2": // Salida

                    if( $registro->almacen_id == $data['almacen_id'] && $registro->transito == '0' ) // SI ESTA EN EL ALMACEN
                    {
                        $mov[0]=[
                            'almacen_id'=> $data['almacen_id'],
                            'movimiento_id' => $data['movimiento_id'],
                            'fecha'=> date('Y-m-d H:i:s'),
                            'trasp_id' => $data['trasp_id'],
                            'user' => $user->id,
                        ];

                        $registro->movimientos()->attach($mov);

                        $registro->transito = 1;
                        $registro->save();
                        $registrado = true;

                        $lista = Movimiento::lista(['id' => $data['trasp_id'] ])->get();
                        $tras = Traspaso::find($data['trasp_id']);
                        $dato=[
                            'id' => $data['trasp_id'],
                            'folio' =>$data['folio'],
                            'movimiento_id' => $data['movimiento_id'],
                            'desc_insumo' => $registro['desc_insumo'],
                            'recibe' => $tras->recibe,
                            'movimientos' => $lista,
                            'movimientos_detallados' => $tras->ItemsArray,
                            'edit' => $tras->edit,
                        ];
                    }

                    break;
                case "6": // Traspaso

                    if( $registro->almacen_id == $data['almacen_id'] )
                    {
                        $mov[0]=[
                            'almacen_id'=> $data['almacen_id'],
                            'movimiento_id' => $data['movimiento_id'],
                            'fecha'=> date('Y-m-d H:i:s'),
                            'user' => $user->id,
                        ];
                        $registro->movimientos()->attach($mov);
                        
                        $data['transito'] = 6;                        
                        $registro->almacen_id = $data['almacen_id'];
                        $registro->transito = $data['transito'];
                        $registro->save();

                        $registrado = true;
                        $dato=[
                            'folio' =>$data['folio'],
                            'movimiento_id' => $data['movimiento_id'],
                            'desc_insumo' => $registro['desc_insumo'],
                        ];
                    }

                break;
                case "3": // Cancelacion - Si esta vendido o traspasado,
                          // y el almacen que al que regresa debe ser el mismo que libero
                    $admin_user = User::where('tarjeta','=',$data['tarjeta'])->first();

                    if(!empty($admin_user)){
                        if($admin_user->tipo == 3){
                            if( ( $registro->transito == 4 || $registro->transito == 6 ) && ($registro->almacen_id == $data['almacen_id']) )
                            {
                                $mov[0]=[
                                    'almacen_id'=> $data['almacen_id'],
                                    'movimiento_id' => $data['movimiento_id'],
                                    'fecha'=> date('Y-m-d H:i:s'),
                                    'user' => $user->id,
                                ];
                                $registro->movimientos()->attach($mov);
                                
                                $registro->almacen_id = $data['almacen_id'];
                                $registro->transito = 0;
                                $registro->save();
                                
                                $registrado = true;
                                $dato=[
                                    'folio' =>$registro->folio,
                                    'movimiento_id' => $registro->movimiento_id,
                                    'desc_insumo' => $registro['desc_insumo'],
                                ];
                            }
                        }
                    }
                break;
            }
            $ubicacion=[
                'almacen' => $registro->almacen->nombre,
                'transito' => $registro->transito,
            ];
        }
        return response()->json(['registrado' => $registrado, 'ubicacion'=> $ubicacion, 'movimiento' => $dato ]);
    }
    
    public function movimientosPorFolio($folio){
        $lista = Movimientos::where('id_botella','=',$folio)->get();
        return response()->json($lista);
    }
    
    public function reportes(){
        $lista='';
        $reporte='';

        $fechaInicial = $_GET["fechaInicial"]; $tipo=1;
        if( isset($_GET["fechaFinal"]) ) { $fechaFinal = $_GET["fechaFinal"]; $tipo=$tipo+1; }
        if( isset($_GET["almacen"]) )    { $almacen    = $_GET["almacen"];    $tipo=$tipo+2; }
        if( isset($_GET["movimiento"]) ) { $movimiento = $_GET["movimiento"]; $tipo=$tipo+4; }

        switch($tipo){
            case 1: // Fecha inicial
                $lista = Movimiento::where('fecha','like',$fechaInicial.'%')->get();
            break;
            case 2: // Fecha inicial, Fecha final
                $lista = Movimiento::whereDate('fecha','>=',$fechaInicial)
                        ->whereDate('fecha','<=',$fechaFinal)->get();
            break;
            case 3: // Fecha inicial, Almacen
                $lista = Movimiento::where('fecha','like',$fechaInicial.'%')
                        ->where('almacen_id','=',$almacen)->get();
            break;
            case 4: // Fecha inicial, Fecha final, Almacen
                 $lista = Movimiento::whereDate('fecha','>=',$fechaInicial)
                        ->whereDate('fecha','<=',$fechaFinal)
                        ->where('almacen_id','=',$almacen)->get();
            break;
            case 5: // Fecha inicial, movimiento
                $lista = Movimiento::where('fecha','like',$fechaInicial.'%')
                ->where('movimiento_id','=',$movimiento)->get();
            break;
            case 6: // Fecha inicial, Fecha final, Movimiento 
                 $lista = Movimiento::whereDate('fecha','>=',$fechaInicial)
                        ->whereDate('fecha','<=',$fechaFinal)
                        ->where('movimiento_id','=',$movimiento)->get();
            break;
            case 7: // Fecha inicial, almacen, movimiento
                $lista = Movimiento::where('fecha','like',$fechaInicial.'%')
                        ->where('almacen_id','=',$almacen)
                        ->where('movimiento_id','=',$movimiento)->get();
            break;
            case 8: // Fecha inicial, Fecha final, almacen, movimiento
                $lista = Movimiento::whereDate('fecha','>=',$fechaInicial)
                        ->whereDate('fecha','<=',$fechaFinal)
                        ->where('almacen_id','=',$almacen)
                        ->where('movimiento_id','=',$movimiento)->get();
            break;
        }

        if(!$lista->isEmpty())
        {
            $reporte = $lista->transform(function($datos)
            {
                return $this->GenerarReporte($datos);
            });
        }

        return response()->json($reporte);
    }

    public function GenerarReporte($datos)
    {
        return [
            'fecha' =>         $datos->fecha,
            'movimiento_id' => $datos->movimiento_id,
            'botella_id' =>    $datos->botella->folio,
            'botella_desc' =>  $datos->botella->desc_insumo,
            'almacen_id' =>    $datos->almacen->nombre,
        ];
    }

    public function generarReporteDeTraspaso($traspaso)
    {
        $data = Movimiento::lista(['id' => $traspaso])->get();
        $dataTraspaso = Traspaso::find($traspaso);

        $dataTraspaso->edit = 0;

        $dataTraspaso->save();

        $pdf = PDF::loadView('pdf.traspaso', ['data'=>$data, 'dataTraspaso' => $dataTraspaso] );
        $pdf->setPaper('letter');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(25, 760, "WeNatives 2019.", null, 10, array(0, 0, 0));
        return $pdf->stream("Movimientos.pdf");
    }

    public function imprimirReporteDeBusqueda()
    {

        $lista='';
        $reporte='';

        $fechaFinal=NULL;
        $almacen=NULL;
        $movimiento=NULL;
        
        $fechaInicial = $_GET["fechaInicial"]; $tipo=1;
        if( isset($_GET["fechaFinal"]) ) { $fechaFinal = $_GET["fechaFinal"]; $tipo=$tipo+1; }
        if( isset($_GET["almacen"]) )    { $almacen    = $_GET["almacen"];    $tipo=$tipo+2; }
        if( isset($_GET["movimiento"]) ) { $movimiento = $_GET["movimiento"]; $tipo=$tipo+4; }

        switch($tipo){
            case 1: // Fecha inicial
                $lista = Movimiento::where('fecha','like',$fechaInicial.'%')->get();
            break;
            case 2: // Fecha inicial, Fecha final
                $lista = Movimiento::whereDate('fecha','>=',$fechaInicial)
                        ->whereDate('fecha','<=',$fechaFinal)->get();
            break;
            case 3: // Fecha inicial, Almacen
                $lista = Movimiento::where('fecha','like',$fechaInicial.'%')
                        ->where('almacen_id','=',$almacen)->get();
            break;
            case 4: // Fecha inicial, Fecha final, Almacen
                 $lista = Movimiento::whereDate('fecha','>=',$fechaInicial)
                        ->whereDate('fecha','<=',$fechaFinal)
                        ->where('almacen_id','=',$almacen)->get();
            break;
            case 5: // Fecha inicial, movimiento
                $lista = Movimiento::where('fecha','like',$fechaInicial.'%')
                ->where('movimiento_id','=',$movimiento)->get();
            break;
            case 6: // Fecha inicial, Fecha final, Movimiento 
                 $lista = Movimiento::whereDate('fecha','>=',$fechaInicial)
                        ->whereDate('fecha','<=',$fechaFinal)
                        ->where('movimiento_id','=',$movimiento)->get();
            break;
            case 7: // Fecha inicial, almacen, movimiento
                $lista = Movimiento::where('fecha','like',$fechaInicial.'%')
                        ->where('almacen_id','=',$almacen)
                        ->where('movimiento_id','=',$movimiento)->get();
            break;
            case 8: // Fecha inicial, Fecha final, almacen, movimiento
                $lista = Movimiento::whereDate('fecha','>=',$fechaInicial)
                        ->whereDate('fecha','<=',$fechaFinal)
                        ->where('almacen_id','=',$almacen)
                        ->where('movimiento_id','=',$movimiento)->get();
            break;
        }
        $reporte = $lista->transform( function($datos) { return $this->GenerarReporte($datos); } );
        $logo = storage_path('/app/images/papaslogoonwhite.jpg');
        $pdf = PDF::loadView('pdf.reporte', ['fecha1'=>$fechaInicial, 'fecha2'=>$fechaFinal, 'area'=>$almacen, 'movimiento'=>$movimiento, 'movimientos'=> $reporte] );
        $pdf->setPaper('letter');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf ->get_canvas();
        $canvas->image($logo, 35, 38, 100, 32);
        $canvas->page_text(25, 760, "WeNatives 2019.", null, 10, array(0, 0, 0));
        $canvas->page_text(520, 760, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream("Movimientos.pdf");
    }

     public function GenerarReporteDeInventario($datos)
    {
        return [
            'id' =>          $datos->folio,
            'insumo' =>      $datos->insumo,
            'desc_insumo' => $datos->desc_insumo,
            'almacen_id' =>  $datos->almacen->nombre,
            'cantidad'   =>  $datos->cantidad,
        ];
    }

    /**/
    /*
                    \ \|/ /
                     (O O)
        +--------oOO--(_)--------------+
        |       Codigo Rico Alert      |
        +-----------------oOO----------+
                    |__|__|
                     | | |
                    ooO Ooo
    */
    public function inventarioPorArea($area){

        /*utilizaremos un scope en el modelo de botella*/
        $reporte = botella::InventarioPorArea([
            'almacen'=>$area,
            'desglosar'     => isset($_GET["desglosar"]) ? $_GET["desglosar"] : null, 
            'take'     => isset($_GET["take"]) ? $_GET["take"] : null,                     
            'skip'    => isset($_GET["skip"]) ? $_GET["skip"] : null,
            'pdf'=>0,
            ])->get();
        $conteo = botella::InventarioPorAreaConteo([
            'almacen'=>$area,
            'desglosar'     => isset($_GET["desglosar"]) ? $_GET["desglosar"] : null,
            ])->get();

        $reporte->transform(function($datos)
        {
            return $this->GenerarReporteDeInventario($datos);
        });

        return response()->json(['botellas'=>$reporte,'total'=>$conteo[0]['total'] ]);
    }

     public function inventarioPorAreaPDF($area,$desglosar){

        /*utilizaremos un scope en el modelo de botella*/
        $reporte = botella::InventarioPorArea([
            'almacen'   =>$area,
            'desglosar' => $desglosar, 
            'pdf'       =>1,
        ])->get();
        $fecha = date('d/m/Y');
        $hora = date('H:i:s', time());
       
        $reporte->transform(function($datos)
        {
            return $this->GenerarReporteDeInventario($datos);
        });
       
        if((int)$area==9999){
            $almacen='Todas Las Areas';
        }
        else{
            $registro=Almacen::find($area);
            $almacen=$registro->nombre;
        }
        $logo = storage_path('/app/images/papaslogoonwhite.jpeg');

        if((int)$desglosar==0){
        $pdf = PDF::loadView('pdf.inventarioAgrupado', ['data'=>$reporte,'almacen'=>$almacen,'fecha'=>$fecha,'hora'=>$hora] );
        $pdf->setPaper('letter');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf ->get_canvas();
        $canvas->image($logo, 30, 38, 80, 32);
        $canvas->page_text(25, 760, "WeNatives 2019.", null, 10, array(0, 0, 0));
        $canvas->page_text(520, 760, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream("Inventario.pdf");
        }
        else{
            $pdf = PDF::loadView('pdf.inventarioDesgloce', ['data'=>$reporte,'almacen'=>$almacen,'fecha'=>$fecha,'hora'=>$hora] );
            $pdf->setPaper('letter');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf ->get_canvas();
            $canvas->image($logo, 30, 38, 80, 32);
            $canvas->page_text(25, 760, "WeNatives 2019.", null, 10, array(0, 0, 0));
            $canvas->page_text(520, 760, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
            return $pdf->stream("Inventario.pdf");
        }



        return response()->json(['botellas'=>$reporte ]);
        }
    



}