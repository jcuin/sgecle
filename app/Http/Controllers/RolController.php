<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RolRequest;
use App\Rol;

class RolController extends Controller
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
        //
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        $roles = Rol::where('rol_key', 'like', '%'.$criterio.'%')
        ->orwhere('rol', $criterio)
        ->orwhere('id_rol', $criterio)
        ->sortable()
        ->orderBy('id_rol')
        ->paginate(10);
        
        return view('Rol.index',compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Rol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        //
        $rol = new Rol;
        $rol -> rol_key = $request -> rol_key;
        $rol -> rol = $request -> rol;
        $rol -> descripcion = $request -> descripcion;
        $guardado = $rol -> save();
        
        if($guardado)
            return redirect()->route('Rol.index')->with('info','Rol creado con éxito.');
        else
            return redirect()->route('Rol.index')->with('error','Imposible guardar Rol.');
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
        $rol = Rol::findOrFail($id);
        return view('Rol.show', compact('rol'));
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
        $rol = Rol::findOrFail($id);
        return view('Rol.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        //
        $rol = Rol::findOrFail($id);
        $rol -> rol_key = $request -> rol_key;
        $rol -> rol = $request -> rol;
        $rol -> descripcion = $request -> descripcion;
        $guardado = $rol -> save();
        if($guardado)
            return redirect()->route('Rol.index')->with('info','Rol actualizado con éxito.');
        else
            return redirect()->route('Rol.index')->with('error','Imposible actualizar Rol.');
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
        $destruido = Rol::destroy($id);
        if($destruido)
            return redirect()->route('Rol.index')->with('info','Rol eliminado con éxito.');
        else
            return redirect()->route('Rol.index')->with('error','Imposible borrar Rol.');
    }
}
