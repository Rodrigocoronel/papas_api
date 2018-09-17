<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Expression as Expression;

use App\Movimientos;

class controladorMovimientos extends Controller
{

     public function registro(Request $request){
       
        $user = $request->input();
        $user['password'] = bcrypt($user['password']);
        $registro = User::create($user);

        return response()->json($this->build_user($registro));

    }


    public function show($id)
    {

            $data = User::find($id);
            return response()->json($data);
    }



    public function build_user($u){
        return [
            'value' => $u->id,
            'label' => $u->name,
            'correo' => $u->email,];
    }








}