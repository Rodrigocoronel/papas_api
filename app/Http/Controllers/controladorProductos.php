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

    public function buildProductoList($item)
    {
        return [
            'id' => $item->id,
            'insumo' => $item->insumo,
            'desc_insumo' => $item->desc_insumo
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


    public function index(){

        $insumo = isset($_GET["insumo"]) ? $_GET["insumo"] : null;
        $desc_insumo = isset($_GET["desc_insumo"]) ? $_GET["desc_insumo"] : null;
        $take = isset($_GET["take"]) ? $_GET["take"] : null;
        $skip = isset($_GET["skip"]) ? $_GET["skip"] : null;

        $data = Producto::lista([
            'insumo' => $insumo,
            'desc_insumo' => $desc_insumo,
            'take' => $take,
            'skip' => $skip
        ])->get();

        $total = Producto::conteo([
            'insumo' => $insumo,
            'desc_insumo' => $desc_insumo,
        ])->get();

        $out = [];

        // $out = $data->transform( function($item){
        //     return $this->buildProductoList($item);
        // });

        return response()->json([ 'rows' => $data ,'total' => $total[0]['total'] ]);
    }

    public function producto_edit($id){

        $prod = Producto::find($id);

        return response()->json( $this->buildProductoList($prod) );
    }

    public function save(Request $request){

        $data = $request->input();

        $error = false;

        try {
            $new = Producto::create($data);
        } catch (\Exception $e) {
            $error = true;
        }
        

        return response()->json($error);
        
    }


    public function update(Request $request){
        $data = $request->input();

        $error = false;

        try {
            $prod = Producto::find($data['id']);

            $prod->insumo = $data['insumo'];
            $prod->desc_insumo = $data['desc_insumo'];

            $prod->save();
        } catch (\Exception $e) {
            $error = true;
        }
        

        return response()->json($error);
    }

}