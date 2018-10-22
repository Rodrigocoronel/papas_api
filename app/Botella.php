<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botella extends Model
{
    protected $table = 'botella';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
        'id',
        'folio',
        'insumo',
        'desc_insumo',
        'fecha_compra',
        'almacen_id',
        'transito'
    ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];
    
    public function movimienPorBotella()
    {
        return $this->hasMany('App\Movimiento');
    }
    
    public function movimientos() {
        return $this->belongsToMany(
            'App\Almacen',
            'lista_movimientos',
            'botella_id',
            'almacen_id')
            ->withPivot(
            'movimiento_id',
            'fecha',
            'user'
        );
    }
    
    public function almacen()
    {
        return $this->belongsTo('App\Almacen', 'almacen_id');
    }
        
    public function getMovimientoArrayAttribute() {

        $output = [];

        foreach ($this->movimientos as $movimiento) {

            $output[] = [
                "id"                => $movimiento->id,
                "botella_id"        => $movimiento->pivot->botella_id,
                "movimiento_id"     => $movimiento->pivot->movimiento_id,
                "almacen_id"        => $movimiento->pivot->almacen_id,
                "almacen_nombre"    => $movimiento->nombre,
                "fecha"             => $movimiento->pivot->fecha,
                "user"              => $movimiento->pivot->user,
            ];
        }
        return $output;
    }

}
