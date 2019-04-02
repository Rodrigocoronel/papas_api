<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;
use PDF;

use App\Movimiento;
use App\Botella;

class controladorMovimientos extends Controller
{
    public function registrarMovimiento(Request $datos){
        
        $user = $datos->user();
        $data = $datos->input();
        $dato = ['temp'=>1];
        $tipoDeSalida = 0;
        
        $registrado = false;
        if(Botella::where('folio','=',$data['folio'])->exists())
        {
            $registro = Botella::where('folio','=',$data['folio'])->first();
            switch($data['movimiento_id'])
            {
                case "1": // Entrada - El producto debe tener Almacen_actual = 0 (en transito)
                    if($registro->almacen_id == '0')
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
                    $tipoDeSalida = $tipoDeSalida - 1;
                case "4": // Venta
                    $tipoDeSalida = $tipoDeSalida - 1;    
                case "2": // Salida
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
                        
                        $data['transito'] = $data['almacen_id'];
                        $data['almacen_id'] = $tipoDeSalida;
                        
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
                case "3": // Cancelacion - Almacen_actual debe ser 0 si esta en transito, o -1 si esta vendido,
                          // y el almacen que al que regresa debe ser el mismo que libero
                    if( ( $registro->almacen_id == 0 || $registro->almacen_id == -1 ) && ($registro->transito == $data['almacen_id']) )
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
                            'movimiento_id' => (string)$registro->movimiento_id,
                            'desc_insumo' => $registro['desc_insumo'],
                        ];
                    }
                break;
            }
        }
        return response()->json(['registrado' => $registrado, 'movimiento' => $dato ]);
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

    public function generarReporteDeTraspaso()
    {
        $Area = [];
        $Concentrado = [];
        $pdf = PDF::loadView('pdf.traspaso', ['area'=>$Area, 'movimiento'=> $Concentrado] );
        $pdf->setPaper('letter');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(25, 760, "WeNatives 2019.", null, 10, array(0, 0, 0));
        return $pdf->stream("Movimientos.pdf");
    }

    public function imprimirReporteDeBusqueda()
    {
        $Concentrado = [];
        $pdf = PDF::loadView('pdf.reporte', ['movimiento'=> $Concentrado] );
        $pdf->setPaper('letter');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(25, 760, "WeNatives 2019.", null, 10, array(0, 0, 0));
        $canvas->page_text(520, 760, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream("Movimientos.pdf");
    }

}