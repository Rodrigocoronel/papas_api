<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traspaso extends Model
{
    protected $table = 'traspasos';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
                'id',
                'user',
                'recibe',
                'edit'
            ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

    public function user_rel()
    {
        return $this->belongsTo('App\user', 'user' , 'id');
    }

    public function contenido_traspaso()
    {
        return $this->hasMany('App\Movimiento' , 'trasp_id' , 'id');
    }

    public function getItemsArrayAttribute() {

        $output = [];

        foreach ($this->contenido_traspaso as $item) {
           
            $output[] = [
                'id'  => $item->id,
                'folio' => $item->folio,
                'movimiento_id' => $item->movimiento_id,
                'desc_insumo' => $item->desc
            ];
        
        }

        return $output;

    }

}