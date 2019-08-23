<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
                'id',
                'insumo',
                'desc_insumo'
            ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];


}
