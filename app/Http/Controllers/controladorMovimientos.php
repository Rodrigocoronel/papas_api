<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;

use App\Movimiento;
use App\Botella;

class controladorMovimientos extends Controller
{
    public function registrarMovimiento(Request $datos){
        
        $user = $datos->user();
        $data = $datos->input();
        $tipoDeSalida = 0;
        
        $registrado = false;
        if(Botella::where('folio','=',$data['folio'])->exists())
        {
            $registro = Botella::where('folio','=',$data['folio'])->first();
            switch($data['movimiento_id'])
            {
                case "1": // Entrada - El producto debe tener Almacen_actual = 0 (en transito)
                    if($registro->almacen_id == '0')
                    {   // Debe de provenir de almacen-1 o algun almacen mayor a 1
                        if( (((int)$registro->transito)+1 == (int)$data['almacen_id']) || ((int)$registro->transito > 1) )
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
                        }
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
                    }
                break;
            }
        }
        return response()->json($registrado);
    }
    
    public function movimientosPorFolio($folio){
        $lista = Movimientos::where('id_botella','=',$folio)->get();
        return response()->json($lista);
    }
    
    public function salidas($area,$fecha){
        $lista = Movimientos::where('id_origen','=',$area)->where('fecha','=',$fecha)->get();
        return response()->json($lista);
    }
}