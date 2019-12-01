<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression as Expression;

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


    public function scopeLista($query, $params = []) {

        $select = array();            
        
        $select[] = new Expression ('productos.*');
        // $select[] = new Expression ('if( sum(item_list.cantidad * item_list.precio),sum(item_list.cantidad * item_list.precio) ,0 ) as total'); 

        $query->select($select);

        if ($params['insumo'] != '')
            $query->where( 'insumo','like','%'.$params['insumo'].'%' );

        if ($params['desc_insumo'] != '')
            $query->where('desc_insumo','like','%'.$params['desc_insumo'].'%');

        
        $query->take($params['take']);

        $query->skip($params['skip']);

        $query->orderby('created_at','DESC' );

        return $query;
    }

    public function scopeConteo($query, $params = []) {
        
       $select = array();            
        
        $select[] = new Expression ('count(id) as total');
        // $select[] = new Expression ('if( sum(item_list.cantidad * item_list.precio),sum(item_list.cantidad * item_list.precio) ,0 ) as total'); 

        $query->select($select);

        if ($params['insumo'] != '')
            $query->where( 'insumo','like','%'.$params['insumo'].'%' );

        if ($params['desc_insumo'] != '')
            $query->where('desc_insumo','like','%'.$params['desc_insumo'].'%');

        return $query;

    }

}
