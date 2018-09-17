<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    protected $table = 'lista_movimientos';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
                'id',
                'id_botella',
                'id_mov',
                'id_origen',
                'id_destino',
                'fecha',
                'user'
            ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

}
