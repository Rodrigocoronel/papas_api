<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;
use PDF;

use App\Traspaso;
use App\Movimiento;
use App\Almacen;


class TraspasosController extends Controller
{
    public function create(Request $request){

        $data = $request->input();

        $user = $request->user();

        $error = false;
        $new = [];

        $data['destino'] => 
        $lastRecod = Traspaso::where('user','=',$user->id)->orderBy('id', 'DESC')->first();

        $data['user'] = $user->id;
        $data['edit'] = 1;

        if($lastRecod){
            if( count($lastRecod->ItemsArray) > 0 ){
                $new = Traspaso::create($data);
            }else{
                $error = true;
            }
        }
        else{
            $new = Traspaso::create($data);
        }
        

        if($error){
            return response()->json([ 'error' => $error, 'lel' => $lastRecod->ItemsArray ]);
        }else{
            return response()->json( [ 'error' => $error, 'trasp' => $this->buildTraspaso($new) ]);
        }
        

    }

    public function lastRecord(Request $request){

        $user = $request->user();

        $lastRecod = Traspaso::where('user','=',$user->id)->orderBy('id', 'DESC')->first();

        if( $lastRecod ){

            $lista = Movimiento::lista(['id' => $lastRecod->id ])->get();

            return response()->json( ['error' => false , 'trasp' => $this->buildTraspaso($lastRecod, $lista)] );
        
        }else{

            return response()->json( ['error' => true, 'trasp' => $lastRecod ] );

        }

        

    }

    public function buildTraspaso($item, $movimientos = [])
    {
        return 
        [
            'id' => $item->id,
            'recibe' => $item->recibe,
            'origen' => $item->origen,
            'destino' => $item->destino,
            'movimientos' => $movimientos != [] ? $movimientos : [],
            'movimientos_detallados' => $item->ItemsArray,
            'edit' => $item->edit
        ];
    }

}

?>