<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class historiaclinica
 * @package App\Models
 * @version October 21, 2021, 2:21 am UTC
 *
 * @property string $paciente
 * @property string $fecha
 */
class Historiaclinica extends Model
{
    //
     //use SoftDeletes;

     public $table = 'historia_clinica';
     protected $primaryKey= 'idhistoria_clinica';
     public $timestamps =false;
 
     
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
 
 
     protected $dates = ['deleted_at'];
 
 
 
     public $fillable = [
         'idhistoria',
         'fechaentrada',
         'fechaalta',
         'numseguro'
     ];
 
     /**
      * The attributes that should be casted to native types.
      *
      * @var array
      */
     protected $casts = [
         'idhistoria_clinica' => 'integer',
         'idhistoria' => 'string',
         'fechaentrada' => 'string',
         'fechaalta' => 'string',
         'numseguro' => 'string'

     ];
 
     /**
      * Validation rules
      *
      * @var array
      */
     public static $rules = [
         'idhistoria' => 'nullable|string|max:45',
         'fechaentrada' => 'nullable|string|max:45',
         'fechaalta' => 'nullable|string|max:45',
         'numseguro' => 'nullable|string|max:45'
     ];
}
