<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botellas extends Model
{
    protected $table = 'botella';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
                'id',
                'folio',
                'insumo',
                'desc_insumo',
                'fecha_compra'
            ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

}
