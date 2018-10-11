<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;

use App\Almacen;

class controladorAlmacenes extends Controller
{
    public function registrarAlmacen(Request $datos){
        
        $user = $datos->user();
        $data = $datos->input();
        $registrado  = false;
        if(!Almacen::where('nombre','=',$data['nombre'])->exists())
        {
            $registro = Almacen::create($data);
            $registrado = true;
        }
        return response()->json($registrado);
    }
    
    public function almacenPorId($id){
        $registro = Almacen::where('id','=',$id)->get();
        if(!$registro->isEmpty())
        return response()->json($registro);
    }
    
    public function todosLosAlmacenes(){
        $lista = Almacen::all();
        return response()->json($lista);
    }
}