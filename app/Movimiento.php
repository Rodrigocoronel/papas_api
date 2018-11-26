<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'lista_movimientos';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
                'id',
                'botella_id',
                'movimiento_id',
                'almacen_id',
                'fecha',
                'user'
            ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

    public function almacen()
    {
        return $this->belongsTo('App\Almacen', 'almacen_id');
    }

    public function botella()
    {
        return $this->belongsTo('App\Botella', 'botella_id');
    }
}
