<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Usuario
 * @package App\Models
 * @version October 21, 2021, 2:21 am UTC
 *
 * @property string $ape_nom
 * @property string $usuario
 */
class Usuario extends Model
{
    //
     //use SoftDeletes;

     public $table = 'usuario';
     protected $primaryKey= 'idusuario';
     public $timestamps =false;
 
     
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
 
 
     protected $dates = ['deleted_at'];
 
 
 
     public $fillable = [
        'dni',
        'ape_nom',
        'usuario',
        'password'
     ];
 
     /**
      * The attributes that should be casted to native types.
      *
      * @var array
      */
     protected $casts = [
         'idusuario' => 'integer',
         'dni' => 'string',
         'ape_nom' => 'string',
         'usuario' => 'string',
         'password' => 'string'
     ];
 
     /**
      * Validation rules
      *
      * @var array
      */
     public static $rules = [
         'dni' => 'nullable|string|max:45',
         'ape_nom' => 'nullable|string|max:45',
         'usuario' => 'nullable|string|max:45',
         'password' => 'nullable|string|max:45'
     ];
}
