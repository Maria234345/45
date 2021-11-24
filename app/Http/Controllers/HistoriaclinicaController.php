<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historiaclinica;
use PDF;

class HistoriaclinicaController extends Controller
{
    //
    public function __construct()
    {
        //$this->clienteRepository = $clienteRepo;
    }

    public function index(Request $request)
    {
        //$clientes = $this->clienteRepository->all();
        $mensajeeloquent="Hola esta funcionando";
        return view('vuehistoriaclinica.index',compact( 'mensajeeloquent'));
    }

    public function createPDF() { 

        $data = Historiaclinica::all(); 
        
        view()->share('historiaclinica',$data); 
        
        $pdf = PDF::loadView('vuehistoriaclinica.pdf_view', $data); 
        
        return $pdf->download('pdf.pdf'); 
        
        } 

    public function lista(Request $request)
    {
        $historiaclinica = Historiaclinica::all();
        return $historiaclinica;
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    public function store(Request $request)
    {
        $historiaclinica = new Historiaclinica();
        $historiaclinica->idhistoria = $request->idhistoria;
        $historiaclinica->fechaentrada = $request->fechaentrada;
        $historiaclinica->fechaalta = $request->fechaalta;
        $historiaclinica->numseguro = $request->numseguro;
        $historiaclinica->save();
        //Esta función guardará las tareas que enviaremos mediante vuejs
    }
    public function show(Request $request)
    {
        $historiaclinica = Historiaclinica::findOrFail($request->idhistoria_clinica);
        return $historiaclinica;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function update(Request $request)
    {
        $historiaclinica = Historiaclinica::findOrFail($request->idhistoria_clinica);

        $historiaclinica->idhistoria = $request->idhistoria;
        $historiaclinica->fechaentrada = $request->fechaentrada;
        $historiaclinica->fechaalta = $request->fechaalta;
        $historiaclinica->numseguro = $request->numseguro;

        $historiaclinica->save();

        return $historiaclinica;

       
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

    public function destroy(Request $request)
    {
        $historiaclinica = Historiaclinica::destroy($request->idhistoria_clinica);
        return $historiaclinica;
        //Esta función obtendra el idcliente de la tarea que hayamos seleccionado y la borrará de nuestra BD
    }

}