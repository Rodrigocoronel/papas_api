<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression as Expression;

class Movimiento extends Model
{
    protected $table = 'lista_movimientos';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
                'id',
                'botella_id',
                'movimiento_id',
                'almacen_id',
                'trasp_id',
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

    public function getFolioAttribute() {

        return $this->botella->folio;

    }

    public function getDescAttribute() {

        return $this->botella->desc_insumo;

    }

    public function scopeLista($query, $params=[]) { 

        $select = array();
        $select[] = new Expression("botella.desc_insumo as descs");
        $select[] = new Expression("lista_movimientos.movimiento_id as movimiento_id");
        $select[] = new Expression("traspasos.recibe as recibe");
        $select[] = new Expression("count(lista_movimientos.id) as qty");

        $query->select($select);  

        $query ->join('botella', 'botella.id', '=', 'botella_id');
        $query ->join('traspasos', 'traspasos.id', '=', 'trasp_id'); 

        if( $params['id'] != null )
            $query->where('lista_movimientos.trasp_id','=',$params['id']);

        $query->groupby('descs');

        return $query;
    
    }
}
