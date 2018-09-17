<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Query\Expression as Expression;

use App\Botellas;

class controladorBotellas extends Controller
{

    public function todasLasBotellas($id){
        $var = Botellas::find($id);
        
        return response()->json($var);
    }








}