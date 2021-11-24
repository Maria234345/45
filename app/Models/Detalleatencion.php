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
class Detalleatencion extends Model
{
    //
     //use SoftDeletes;

     public $table = 'detalle_atencion';
     protected $primaryKey= 'iddetalle_atencion';
     public $timestamps =false;
 
     
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
 
 
     protected $dates = ['deleted_at'];
 
 
 
     public $fillable = [
         'idhistoria',
         'iddoctor',
         'fecha',
         'sintomas',
         'tratamientos'
     ];
 
     /**
      * The attributes that should be casted to native types.
      *
      * @var array
      */
     protected $casts = [
         'iddetalle_atencion' => 'integer',
         'idhistoria' => 'string',
         'iddoctor' => 'string',
         'fecha' => 'string',
         'sintomas' => 'string',
         'tratamientos' => 'string'

     ];
 
     /**
      * Validation rules
      *
      * @var array
      */
     public static $rules = [
         'idhistoria' => 'nullable|string|max:45',
         'iddoctor' => 'nullable|string|max:45',
         'fecha' => 'nullable|string|max:45',
         'sintomas' => 'nullable|string|max:45',
         'tratamientos' => 'nullable|string|max:45'
     ];
}
