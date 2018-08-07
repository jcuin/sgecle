<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EscolaridadRequest;
use App\Escolaridad;

class EscolaridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct(){
        $this -> middleware(['auth', 'roles:dir_general']);
    }*/
    
    public function index()
    {
        //
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        $escolaridades = Escolaridad::where('escolaridad', 'like', '%'.$criterio.'%')
        ->orwhere('id_escolaridad', $criterio)
        ->sortable()
        ->orderBy('id_escolaridad')
        ->paginate(10);
        
        return view('Escolaridad.index',compact('escolaridades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Escolaridad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscolaridadRequest $request)
    {
        //
        $escolaridad = new Escolaridad;
        $escolaridad -> escolaridad = $request -> escolaridad;
        $escolaridad -> nomenclatura_grupos = $request -> nomenclatura_grupos;
        $escolaridad -> horario = $request -> horario;
        $guardado = $escolaridad -> save();
        if($guardado)
            return redirect()->route('Escolaridad.index')->with('info','Escolaridad creada con éxito.');
        else
            return redirect()->route('Escolaridad.index')->with('error','Imposible guardar Escolaridad.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $escolaridad = Escolaridad::findOrFail($id);
        return view('Escolaridad.show', compact('escolaridad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $escolaridad = Escolaridad::findOrFail($id);
        return view('Escolaridad.edit', compact('escolaridad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EscolaridadRequest $request, $id)
    {
        //
        $escolaridad = Escolaridad::findOrFail($id);
        $escolaridad -> escolaridad = $request -> escolaridad;
        $escolaridad -> nomenclatura_grupos = $request -> nomenclatura_grupos;
        $escolaridad -> horario = $request -> horario;
        $guardado = $escolaridad -> save();
        if($guardado)
            return redirect()->route('Escolaridad.index')->with('info','Escolaridad actualizada con éxito.');
        else
            return redirect()->route('Escolaridad.index')->with('error','Imposible actualizar Escolaridad.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $destruido = Escolaridad::destroy($id);
        if($destruido)
            return redirect()->route('Escolaridad.index')->with('info','Escolaridad eliminada con éxito.');
        else
            return redirect()->route('Escolaridad.index')->with('error','Imposible borrar Escolaridad.');
    }
}
