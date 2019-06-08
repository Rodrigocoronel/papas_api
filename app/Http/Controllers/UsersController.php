<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Expression as Expression;

use App\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function get_user_id($id){
        
        $output = User::find($id);

        return response()->json($output);
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

    public function build_user($u){
        return [
            'value' => $u->id,
            'label' => $u->name,
            'correo' => $u->email,
        ];
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

    public function login(Request $request)
    {

        $this->validate($request, [
            'password'       => 'required|string',
        ]);

        $data = $request->input();

        $credentials = request(['password']);
        
        $user = User::where('tarjeta','=',$data['password'])->first();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        
        // $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }
    

}