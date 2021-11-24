<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientecama;

class PacientecamaController extends Controller
{
    //
    public function __construct()
    {
        //$this->pacientecamaRepository = $pacientecamaRepo;
    }

    public function index(Request $request)
    {
        //$pacientecamas = $this->pacientecamaRepository->all();
        $mensajeeloquent="Hola esta funcionando";
        return view('vuecama.index',compact( 'mensajeeloquent'));
    }

    public function lista(Request $request)
    {
        $pacientecama = Pacientecama::all();
        return $pacientecama;
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    public function store(Request $request)
    {
        $pacientecama = new Pacientecama();
        $pacientecama->nom_paciente = $request->nom_paciente;
        $pacientecama->ap_paciente = $request->ap_paciente;
        $pacientecama->dni = $request->dni;
        $pacientecama->num_cama = $request->num_cama;
        $pacientecama->fecha_ingreso = $request->fecha_ingreso;
        $pacientecama->fecha_salida = $request->fecha_salida;
        $pacientecama->save();
        //Esta función guardará las tareas que enviaremos mediante vuejs
    }
    public function show(Request $request)
    {
        $pacientecama = Pacientecama::findOrFail($request->idpacientecama);
        return $pacientecama;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function update(Request $request)
    {
        $pacientecama = Pacientecama::findOrFail($request->idpacientecama);

        $pacientecama->nom_paciente = $request->nom_paciente;
        $pacientecama->ap_paciente = $request->ap_paciente;
        $pacientecama->dni = $request->dni;
        $pacientecama->num_cama = $request->num_cama;
        $pacientecama->fecha_ingreso = $request->fecha_ingreso;
        $pacientecama->fecha_salida = $request->fecha_salida;

        $pacientecama->save();

        return $pacientecama;
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

    public function destroy(Request $request)
    {
        $pacientecama = Pacientecama::destroy($request->idpacientecama);
        return $pacientecama;
        //Esta función obtendra el idpacientecama de la tarea que hayamos seleccionado y la borrará de nuestra BD
    }

}