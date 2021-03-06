<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression as Expression;

class Botella extends Model
{
    protected $table = 'botella';

    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
        'id',
        'factura_id',
        'insumo',
        'desc_insumo',
        'fecha_compra',
        'almacen_id',
        'transito',
        'user_delete',
    ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

    // public function movimienPorBotella()
    // {
    //     return $this->hasMany('App\Movimiento');
    // }

    public function movimientos()
    {
        return $this->belongsToMany(
            'App\Almacen',
            'lista_movimientos',
            'botella_id',
            'almacen_id')
            ->withPivot(
                'movimiento_id',
                'fecha',
                'user'
            )->orderBy('fecha', 'asc');
    }

    public function almacen()
    {
        return $this->belongsTo('App\Almacen', 'almacen_id');
    }

    public function usr_delete()
    {
        return $this->belongsTo('App\User', 'user_delete');
    }

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'factura_id');
    }

    public function getMovimientoArrayAttribute()
    {

        $output = [];

        foreach ($this->movimientos as $movimiento) {

            $output[] = [
                "id"             => $movimiento->id,
                "botella_id"     => $movimiento->pivot->botella_id,
                "movimiento_id"  => $movimiento->pivot->movimiento_id,
                "almacen_id"     => $movimiento->pivot->almacen_id,
                "almacen_nombre" => $movimiento->nombre,
                "fecha"          => $movimiento->pivot->fecha,
                "user"           => $movimiento->pivot->user,
            ];
        }
        return $output;
    }
    /**/
    /*
    \ \|/ /
    (O O)
    +--------oOO--(_)--------------+
    |       Codigo Rico Alert      |
    +-----------------oOO----------+
    |__|__|
    || ||
    ooO Ooo
     */
    public function scopeInventarioPorArea($query, $params = [])
    {
        $select   = [];
        $select[] = "botella.*";
        if ((int) $params['desglosar'] == 0) {
            $select[] = new Expression("count(botella.id) as `cantidad`");
        } else {
            $select[] = new Expression("1 as `cantidad`");
        }
        //
        $query->select($select);
        $query->where("transito", '=', 0);

        if ((int) $params['almacen'] == 9999) {
            $query->where("almacen_id", '>', 0);
        } else {
            $query->where("almacen_id", '=', $params['almacen']);
        }

        if ((int) $params['desglosar'] == 0) {
            $query->groupBy("insumo");
            $query->groupBy("almacen_id");
        }

        if ((int) $params['pdf'] == 0) {
            $query->take($params['take']);
            $query->skip($params['skip']);
        }

        if (isset($params['id']) && $params['id'] != null) {
            $query->where('id', 'like', "%" . $params['id'] . "%");
        }

        if (isset($params['insumo']) && $params['insumo'] != null) {
            $query->where('insumo', 'like', "%" . $params['insumo'] . "%");
        }

        if (isset($params['descripcion']) && $params['descripcion'] != null) {
            $query->where('desc_insumo', 'like', "%" . $params['descripcion'] . "%");
        }

        $query->orderBy("botella.insumo", "asc");

        return $query;
    }
    public function scopeInventarioPorAreaConteo($query, $params = [])
    {
        $select   = [];
        $select[] = new Expression("count(botella.id) as `total`");
        $query->select($select);

        $query->where("transito", '=', 0);
        if ((int) $params['almacen'] == 9999) {
            $query->where("almacen_id", '>', 0);
        } else {
            $query->where("almacen_id", '=', $params['almacen']);
        }
        if ((int) $params['desglosar'] == 0) {

            $query->distinct('insumo');
            // $query->groupBy("insumo");
            // $query->groupBy("almacen_id");
        }

        if (isset($params['id']) && $params['id'] != null) {
            $query->where('id', 'like', "%" . $params['id'] . "%");
        }

        if (isset($params['insumo']) && $params['insumo'] != null) {
            $query->where('insumo', 'like', "%" . $params['insumo'] . "%");
        }

        if (isset($params['descripcion']) && $params['descripcion'] != null) {
            $query->where('desc_insumo', 'like', "%" . $params['descripcion'] . "%");
        }

        $query->orderBy("botella.insumo", "asc");

        return $query;
    }

}
