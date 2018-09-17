<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Query\Expression as Expression;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];



     public function scopeLista($query, $params=[]) {

        $select = array();
        $select[] = new Expression ('users.id as value');
        $select[] = new Expression ('name as label');  
        $query->select($select);
        
       

        if( isset($params['value']) && $params['value'] != null )
        $query->orwhere('users.id', 'like', "%".$params['value']."%");
        if( isset($params['label']) && $params['label'] != null )
        $query->orwhere('name', 'like', "%".$params['label']."%");
       

     
        $query->limit(2000);
        $query->take($params['take']);
        $query->skip($params['skip']);
       

        return $query;
    
    }
    public function scopeListaConteo($query, $params=[]) {

       $select = array();
      $select[] = new Expression(" count( id) as total");
      $query->select($select);
   
    

        if( isset($params['value']) && $params['value'] != null )
        $query->orwhere('users.id', 'like', "%".$params['value']."%");
        if( isset($params['label']) && $params['label'] != null )
        $query->orwhere('name', 'like', "%".$params['label']."%");

        return $query;
    }




}
