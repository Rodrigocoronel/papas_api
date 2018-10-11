<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'Almacenes';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
                'id',
                'nombre',
            ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

}
