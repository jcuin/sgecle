<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PeriodoRequest;
use App\Periodo;

class PeriodoController extends Controller
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

        $periodos = Periodo::where('periodo', 'like', '%'.$criterio.'%')
                    ->orwhere('id_periodo', $criterio)
                    ->sortable()
                    ->orderBy('id_periodo')
                    ->paginate(10);
        
        return view('Periodo.index',compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Periodo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeriodoRequest $request)
    {
        //
        $periodo = new Periodo;
        $periodo -> periodo = $request -> periodo;
        $periodo -> trimestre_preescolar = $request -> trimestre_preescolar;
        $periodo -> bimestre_primaria = $request -> bimestre_primaria;
        $periodo -> bimestre_secundaria = $request -> bimestre_secundaria;
        $periodo -> inicio = $request -> inicio;
        $periodo -> termino = $request -> termino;

        $guardado = $periodo -> save();
        if($guardado)
            return redirect()->route('Periodo.index')->with('info','Periodo creado con éxito.');
        else
            return redirect()->route('Periodo.index')->with('error','Imposible guardar Periodo.');
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
        $periodo = Periodo::findOrFail($id);
        return view('Periodo.show', compact('periodo'));
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
        $periodo = Periodo::findOrFail($id);
        return view('Periodo.edit', compact('periodo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeriodoRequest $request, $id)
    {
        //
        $periodo = Periodo::findOrFail($id);
        $periodo -> periodo = $request -> periodo;
        $periodo -> trimestre_preescolar = $request -> trimestre_preescolar;
        $periodo -> bimestre_primaria = $request -> bimestre_primaria;
        $periodo -> bimestre_secundaria = $request -> bimestre_secundaria;
        $periodo -> inicio = $request -> inicio;
        $periodo -> termino = $request -> termino;

        $guardado = $periodo -> save();
        if($guardado)
            return redirect()->route('Periodo.index')->with('info','Periodo actualizado con éxito.');
        else
            return redirect()->route('Periodo.index')->with('error','Imposible actualizar Periodo.');
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
        $destruido = Periodo::destroy($id);
        if($destruido)
            return redirect()->route('Periodo.index')->with('info','Periodo eliminado con éxito.');
        else
            return redirect()->route('Periodo.index')->with('error','Imposible borrar Periodo.');
    }
}