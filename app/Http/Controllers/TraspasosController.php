<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;
use PDF;

use App\Traspaso;
use App\Movimiento;

class TraspasosController extends Controller
{
    public function create(Request $request){

        $data = $request->input();

        $user = $request->user();

        $lastRecod = Traspaso::where('user','=',$user->id)->orderBy('id', 'DESC')->first();

        $data['user'] = $user->id;
        $data['edit'] = 1;

        count($lastRecod->ItemsArray){
            $new = Traspaso::create($data);
        }

        

        return response()->json($this->buildTraspaso($new));

    }

    public function lastRecord(Request $request){
        $user = $request->user();

        $lastRecod = Traspaso::where('user','=',$user->id)->orderBy('id', 'DESC')->first();

        $lista = Movimiento::lista(['id' => $lastRecod->id ])->get();

        return response()->json($this->buildTraspaso($lastRecod, $lista));
    }

    public function buildTraspaso($item, $movimientos = [])
    {
        return 
        [
            'id' => $item->id,
            'recibe' => $item->recibe,
            'movimientos' => $movimientos != [] ? $movimientos : [],
            'movimientos_detallados' => $item->ItemsArray,
            'edit' => $item->edit
        ];
    }

}

?>