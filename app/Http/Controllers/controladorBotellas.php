<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;

use App\Botella;

class controladorBotellas extends Controller
{
    public function registrarBotella(Request $datos){
        
        $user = $datos->user();
        $data = $datos->input();
        $registrado  = false;
        if(!Botella::where('folio','=',$data['folio'])->exists())
        {
            $registro = Botella::create($data);
            $mov[0] =[
                "almacen_id"=> 1,               // 1 - Almacen General
                'movimiento_id' => 1,           // 1 - Primer movimiento registrado como entrada
                'fecha'=> date('Y-m-d H:i:s'),
                'user' => $user->id,
            ];
            $registro->movimientos()->attach($mov);
            $registrado = true;
        }
        return response()->json($registrado);
    }
    
    public function botellaPorFolio($id){
        $registro = Botella::where('id','=',$id)->first();
        if($registro)
        {
            $registro['almacen'] = $registro->almacen;
            $array=$registro->movimientoArray;
            usort($array,  function ( $a, $b ) { return strtotime($a['fecha']) - strtotime($b['fecha']); });
            $registro['mov'] = $array;
        }
        else
        {
            $registro=false;
        }
        return response()->json($registro);
    }
    
    public function botellaPorCodigoDeInsumo($codigo){
        $lista = Botella::where('insumo','=',$codigo)->get();
        return response()->json($lista);
    }    
    
    public function botellasPorNombre($desc){
        $lista = Botella::where('desc_insumo','LIKE',"%{$desc}%")->get();
        return response()->json($lista);
    }
    
    public function todasLasBotellas(){
        $lista = Botella::all();
        return response()->json($lista);
    }
    
}