<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Expression as Expression;

use App\User;
use Hash;

class UsersController extends Controller
{
    public function registro(Request $request)
    {
        $user = $request->input();
        $user['password'] = bcrypt($user['password']);
        $registro = User::create($user);
        return response()->json($this->build_user($registro));
    }

    public function todosLosUsuarios()
    {
        $lista = User::where('id','>',0)->get();
        if(!$lista->isEmpty())
        {
            $lista[0]['almacen'] = $lista[0]->almacen;
        }
        return response()->json($lista);
    }

    public function update(Request $request)
    {
        $user = $request->input();
        $item = User::find($user['id']);

        if($user['password'] != $item['password'])
        {
            $user['password'] = bcrypt($user['password']);
        }
        $item->update($user);
        return response()->json($this->build_user($item));
    }

    public function tarjeta(Request $request)
    {
        $tarjeta = $request->input();
        return response()->json($tarjeta);
        //$usuario = User::find($tarjeta);

    }

// **********************************************************

    public function changePassword(Request $request, $id){
        $data = $request->input();
        $user = User::find($id);
        $ret = '';
        if(Hash::check($data['currentPass'], $user->password)){
            $user->password = bcrypt($data['password']);
            $user->save();
            $ret = true;
        }else{
            $ret = false;
        }
        return response()->json($ret);
    }

}