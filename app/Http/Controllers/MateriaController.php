<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MateriaRequest;
use App\Materia;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct(){
        $this -> middleware(['auth', 'roles:dir_general,director']);
    }*/
    
    public function index()
    {
        //
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        $materias = Materia::where('materia', 'like', '%'.$criterio.'%')
        ->orwhere('id_materia', $criterio)
        ->sortable()
        ->orderBy('id_materia')
        ->paginate(10);
        
        return view('Materia.index',compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Materia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MateriaRequest $request)
    {
        //
        $materia = new Materia;
        $materia -> materia = $request -> materia;
        $guardado = $materia -> save();
        if($guardado)
            return redirect()->route('Materia.index')->with('info','Materia creada con éxito.');
        else
            return redirect()->route('Materia.index')->with('error','Imposible guardar Materia.');
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
        $materia = Materia::findOrFail($id);
        return view('Materia.show', compact('materia'));
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
        $materia = Materia::findOrFail($id);
        return view('Materia.edit', compact('materia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MateriaRequest $request, $id)
    {
        //
        $materia = Materia::findOrFail($id);
        $materia -> materia = $request -> materia;
        $guardado = $materia -> save();
        if($guardado)
            return redirect()->route('Materia.index')->with('info','Materia actualizada con éxito.');
        else
            return redirect()->route('Materia.index')->with('error','Imposible actualizar Materia.');
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
        $destruido = Materia::destroy($id);
        if($destruido)
            return redirect()->route('Materia.index')->with('info','Materia eliminada con éxito.');
        else
            return redirect()->route('Materia.index')->with('error','Imposible borrar Materia.');
    }
}