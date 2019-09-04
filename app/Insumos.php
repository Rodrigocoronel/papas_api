<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression as Expression;

class Insumos extends Model
{
    protected $table = 'insumos';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
        'id',
        'factura_id',
        'producto_id',
        'cantidad'
    ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

    public $timestamps = false;

    public function productos_rel() {
        return $this->belongsTo('App\Producto','producto_id','id');
    }
    
}
