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
                'remember_token'
            ];

    // Campos de la tabla no visibles para el usuario
    protected $hidden = [];
    
}
