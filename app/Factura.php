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
        'fecha_compra',
        'comprador',
        'proveedor',
        'impreso',
        'rfc_proveedor'
    ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

    public function insumos() {
        return $this->hasMany('App\Insumos','factura_id','id');
    }

    public function bottles() {
        return $this->hasMany('App\Botella','factura_id','id');
    }    

    public function getInsumosProdAttribute() {

        $output = [];

        foreach ($this->insumos as $movimiento) {

            $output[] = [
                'insumo'      => $movimiento->productos_rel->insumo,
                'desc_insumo' =>$movimiento->productos_rel->desc_insumo,

                'insumoSelect' =>  array(
                    'label' => $movimiento->productos_rel->desc_insumo, 
                    'id' => $movimiento->id ,  
                    'value' => $movimiento->productos_rel->insumo 
                ),

                'referencia'  => '',
                'cantidad'    => $movimiento->cantidad,
                'max'         => $movimiento->cantidad,
                'producto_id' => $movimiento->producto_id,
                'impreso' => $movimiento->impreso,
                'fecha_impreso' => $movimiento->fecha_impreso,
            ];
        }
        return $output;
    }


    public function scopeLista($query, $params=[]) { 

        if( isset($params['folio_factura']) && $params['folio_factura'] != null )
            $query->where('folio_factura', 'like', "%".$params['folio_factura']."%");

        if( isset($params['proveedor']) && $params['proveedor'] != null )
            $query->where('proveedor', 'like', "%".$params['proveedor']."%");

        if( isset($params['fecha_compra']) && $params['fecha_compra'] != null )
            $query->where('fecha_compra', 'like', "%".$params['fecha_compra']."%");

        if( isset($params['rfc']) && $params['rfc'] != null )
            $query->where('rfc_proveedor', 'like', "%".$params['rfc']."%");

        if( $params['fecha1'] != '' && $params['fecha2'] != '')
            $query->whereBetween('created_at',[ $params['fecha1'].' 00:00:00' , $params['fecha2'].' 23:59:00']);

        if( $params['fecha1'] != '' && $params['fecha2'] == '' )
            $query->whereBetween('created_at',[ $params['fecha1'].' 00:00:00' , $params['fecha1'].' 23:59:59']);

        $query->take($params['take']);
        $query->skip($params['skip']);
       

        return $query;
    
    }

    public function scopeConteo($query, $params=[]) { 

        if( isset($params['folio_factura']) && $params['folio_factura'] != null )
            $query->where('folio_factura', 'like', "%".$params['folio_factura']."%");

        if( isset($params['proveedor']) && $params['proveedor'] != null )
            $query->where('proveedor', 'like', "%".$params['proveedor']."%");

        if( isset($params['fecha_compra']) && $params['fecha_compra'] != null )
            $query->where('fecha_compra', 'like', "%".$params['fecha_compra']."%");

        if( isset($params['rfc']) && $params['rfc'] != null )
            $query->where('rfc_proveedor', 'like', "%".$params['rfc']."%");

        if( $params['fecha1'] != '' && $params['fecha2'] != '')
            $query->whereBetween('created_at',[ $params['fecha1'].' 00:00:00' , $params['fecha2'].' 23:59:00']);

        if( $params['fecha1'] != '' && $params['fecha2'] == '' )
            $query->whereBetween('created_at',[ $params['fecha1'].' 00:00:00' , $params['fecha1'].' 23:59:59']);

        return $query;
    
    }

    
}
