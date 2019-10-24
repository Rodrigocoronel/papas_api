<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;

use App\Producto;

class controladorProductos extends Controller
{

    public function buildProducto($item)
    {
        return [
            'id' => $item->id,
            'value' => $item->insumo,
            'label' => $item->desc_insumo
        ];
    }

    public function productoPorCodigo($id){
        $registro = Producto::where('insumo','=',$id)->first();


        if($registro)
            $back = $this->buildProducto($registro);
        else
            $back = false;

        return response()->json($back);
    }
    
    public function todosLosProductos(){
        $lista = Producto::all();

        $out = [];

       $out = $lista->transform(function($item){
            return $this->buildProducto($item);
        });

        return response()->json($lista);
    }

}