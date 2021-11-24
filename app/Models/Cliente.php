<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Paciente
 * @package App\Models
 * @version October 21, 2021, 2:21 am UTC
 *
 * @property string $ape_nom
 * @property string $celular
 */
class Cliente extends Model
{
    //
     //use SoftDeletes;

     public $table = 'cliente';
     protected $primaryKey= 'idcliente';
     public $timestamps =false;
 
     
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
 
 
     protected $dates = ['deleted_at'];
 
 
 
     public $fillable = [
         'ape_nom',
         'celular',
         'sexo',
         'dni'
     ];
 
     /**
      * The attributes that should be casted to native types.
      *
      * @var array
      */
     protected $casts = [
         'idcliente' => 'integer',
         'ape_nom' => 'string',
         'celular' => 'string',
         'sexo' => 'string',
         'dni' => 'string'
     ];
 
     /**
      * Validation rules
      *
      * @var array
      */
     public static $rules = [
         'ape_nom' => 'nullable|string|max:45',
         'celular' => 'nullable|string|max:45',
         'sexo' => 'nullable|string|max:45',
         'dni' => 'nullable|string|max:45'
     ];
}