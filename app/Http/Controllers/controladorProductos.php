<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;

use App\Producto;

class controladorProductos extends Controller
{
    public function productoPorCodigo($id){
        $registro = Producto::where('insumo','=',$id)->get();
        if($registro->isEmpty())
        {
            $registro[0]=false;
        }
        return response()->json($registro[0]);
    }
    
    public function todosLosProductos(){
        $lista = Producto::where('id','>',0)->get();
        return response()->json($lista);
    }
}