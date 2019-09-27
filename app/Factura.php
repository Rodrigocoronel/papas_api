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
        'proveedor'
        'impreso'
    ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

    public function insumos() {
        return $this->hasMany('App\Insumos','factura_id','id');
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
                'cantidad'    => 0,
                'max'         => $movimiento->cantidad,
                'producto_id' => $movimiento->id

            ];
        }
        return $output;
    }
    
}
