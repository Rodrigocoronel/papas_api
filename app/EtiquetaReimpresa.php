<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression as Expression;
class EtiquetaReimpresa extends Model
{
    protected $table = 'etiquetas_reimpresas';
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
        'id',
        'destruida_id',
        'nueva_id',
        'user_id'  
    ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

    public function destruida()
    {
        return $this->belongsTo('App\Botella', 'destruida_id');
    }

    public function usr_rel()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function newOne()
    {
        return $this->belongsTo('App\Botella', 'nueva_id');
    }


}
