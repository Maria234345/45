<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detalleatencion;

class DetalleatencionController extends Controller
{
    //
    public function __construct()
    {
        //$this->detalleatencionRepository = $detalleatencionRepo;
    }

    public function index(Request $request)
    {
        //$detalleatencions = $this->detalleatencionRepository->all();
        $mensajeeloquent="Hola esta funcionando";
        return view('vueatencion.index',compact( 'mensajeeloquent'));
    }

    public function lista(Request $request)
    {
        $detalleatencion = Detalleatencion::all();
        return $detalleatencion;
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    public function store(Request $request)
    {
        $detalleatencion = new Detalleatencion();
        $detalleatencion->idhistoria = $request->idhistoria;
        $detalleatencion->iddoctor = $request->iddoctor;
        $detalleatencion->fecha = $request->fecha;
        $detalleatencion->sintomas = $request->sintomas;
        $detalleatencion->tratamientos = $request->tratamientos;
        $detalleatencion->save();
        //Esta función guardará las tareas que enviaremos mediante vuejs
    }
    public function show(Request $request)
    {
        $detalleatencion = Detalleatencion::findOrFail($request->iddetalle_atencion);
        return $detalleatencion;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function update(Request $request)
    {
        $detalleatencion = Detalleatencion::findOrFail($request->iddetalle_atencion);

        $detalleatencion->idhistoria = $request->idhistoria;
        $detalleatencion->iddoctor = $request->iddoctor;
        $detalleatencion->fecha = $request->fecha;
        $detalleatencion->sintomas = $request->sintomas;
        $detalleatencion->tratamientos = $request->tratamientos;

        $detalleatencion->save();

        return $detalleatencion;
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

    public function destroy(Request $request)
    {
        $detalleatencion = Detalleatencion::destroy($request->iddetalle_atencion);
        return $detalleatencion;
        //Esta función obtendra el iddetalleatencion de la tarea que hayamos seleccionado y la borrará de nuestra BD
    }

}