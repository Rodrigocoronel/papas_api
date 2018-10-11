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
                
        $registro = Botella::create($data);
        
        $mov[0] =[
            "almacen_origen_id"=> 0,
            'movimiento_id' => 1,
            'almacen_destino_id' => 1,
            'fecha' => date('Y-m-d'),
            'user' => $user->id,
             
        ];
        
        $registro->productos()->attach($mov);
        
        
        
        return response()->json($mov);
    }
    
    public function botellaPorFolio($folio){
        $registro = Botella::where('folio','=',$folio)->get();
        if(!$registro->isEmpty())
        {
            $registro[0]['almacen'] = $registro[0]->almacen;
            $registro[0]['mov'] = $registro[0]->movimientoArray;
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