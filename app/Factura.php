<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression as Expression;

class Factura extends Model
{
    protected $table = 'facturas';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
        'id',
        'folio_factura',
        'impreso'
    ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];
    
}
