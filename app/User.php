<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    // Campos de la tabla que estan disponibles para modificacion
    protected $fillable = [
                'id',
                'name',
                'email',
                'password',
                'tarjeta',
                'area',
                'tipo',
                'activo',
                'remember_token'
            ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];

    protected $tipos = [
        1 => 'Administrador',
        3 => 'Gerente',
        4 => 'Almacenista (General)',
        5 => 'Almacenista (Licores)',
        6 => 'Barra'
    ];

    public function getTipoTextAttribute(){
        return $this->tipos[$this->tipo];
    }

    public function almacen()
    {
        return $this->belongsTo('App\Almacen', 'area' , 'id');
    }

    
    
}
