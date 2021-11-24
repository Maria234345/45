<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pacientecama
 * @package App\Models
 * @version October 21, 2021, 2:21 am UTC
 *
 * @property string $paciente
 * @property string $fecha
 */
class Pacientecama extends Model
{
    //
     //use SoftDeletes;

     public $table = 'paciente_cama';
     protected $primaryKey= 'idpacientecama';
     public $timestamps =false;
 
     
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
 
 
     protected $dates = ['deleted_at'];
 
 
 
     public $fillable = [
         'nom_paciente',
         'ap_paciente',
         'dni',
         'num_cama',
         'fecha_ingreso',
         'fecha_salida'
     ];
 
     /**
      * The attributes that should be casted to native types.
      *
      * @var array
      */
     protected $casts = [
         'idnompaciente' => 'integer',
         'nom_paciente' => 'string',
         'ap_paciente' => 'string',
         'dni' => 'string',
         'num_cama' => 'string',
         'fecha_ingreso' => 'string',
         'fecha_salida' => 'string'
     ];
 
     /**
      * Validation rules
      *
      * @var array
      */
     public static $rules = [
         'nom_paciente' => 'nullable|string|max:45',
         'ap_paciente' => 'nullable|string|max:45',
         'dni' => 'nullable|string|max:45',
         'num_cama' => 'nullable|string|max:45',
         'fecha_ingreso' => 'nullable|string|max:45',
         'fecha_salida' => 'nullable|string|max:45'
     ];
}
