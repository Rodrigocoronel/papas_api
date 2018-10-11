<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;

use App\Movimiento;

class controladorMovimientos extends Controller
{
    public function registrarMovimiento(Request $datos){
        //$post = new Post;
        //$post->all = $request->all();
        //$post->save();
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