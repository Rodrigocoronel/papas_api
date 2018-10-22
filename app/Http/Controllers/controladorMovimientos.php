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
        
        $registrado = false;
        if(Botella::where('folio','=',$data['folio'])->exists())
        {
            $registro = Botella::where('folio','=',$data['folio'])->first();
            switch($data['movimiento_id'])
            {
                case "1": // Entrada - Almacen al que entra debe ser mayor a Almacen_actual      
                    if( ($registro->almacen_id == '0') && (((int)$registro->transito)+1 == (int)$data['almacen_id']) )
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
                case "2": // Salida - Almacen del que sale debe ser igual a Almacen_actual
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
                        $data['almacen_id'] = 0;
                        
                        $registro->almacen_id = $data['almacen_id'];
                        $registro->transito = $data['transito'];
                        $registro->save();

                        $registrado = true;
                    }
                break;
                case "3": // Cancelacion - Almacen_actual debe ser 0, el almacen que al que regresa debe ser el mismo que libero
                    if( ($registro->almacen_id == 0) && ($registro->transito == $data['almacen_id']) )
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