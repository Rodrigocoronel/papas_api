<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Expression as Expression;

use App\User;
use App\Departamento;
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
        return response()->json($lista);
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
            'correo' => $u->email,
        ];
    }

    public function update(Request $request, $id)
    {
        $user = $request->input();
        $item = User::find($id);

        if($user['password'] != $item['password'])
        {
            $user['password'] = bcrypt($user['password']);
        }
        $item->update($user);
        return response()->json($this->build_user($item));
    }

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

    public function validacion(Request $request)
    {
       $back=true;
       $data = $request->input();
       $encontrados = User::where("email","=",$data['email'])->get(); 
       $cuenta=0;
         foreach ($encontrados as $x) {
             $cuenta++;              
            }
            if((int)$cuenta>0)
            $back=false; 

       return response()->json(['validacion'=>$back,'encontrado'=>$encontrados]);
    }

    public function busqueda() {
        $list = User::lista([
            'value'    => isset($_GET["value"]) ? $_GET["value"] : null,
            'label'     => isset($_GET["label"]) ? $_GET["label"] : null,
            'departamento'     => isset($_GET["departamento"]) ? $_GET["departamento"] : null, 
            'take'     => isset($_GET["take"]) ? $_GET["take"] : null,                     
            'skip'    => isset($_GET["skip"]) ? $_GET["skip"] : null,
        ])->get();

         $output = $list->transform(function($item){
            return $this->build_user($item);
        });

        return response()->json($output);
    }
    public function conteo() {      
        $list =0;  
        $list = User::listaConteo([ 

            'value'    => isset($_GET["value"]) ? $_GET["value"] : null,
            'label'     => isset($_GET["label"]) ? $_GET["label"] : null,
            'departamento'     => isset($_GET["departamento"]) ? $_GET["departamento"] : null, 
           
          ])->get();


         return response()->json($list);  
              

    }
}