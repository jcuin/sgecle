<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabajador;
use App\Informe;
use Auth;

class InformeController extends Controller
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
        $trabajador = Trabajador::findOrFail(Auth::user() -> id_trabajador);
        if(isset($trabajador -> adscripcion -> id_escolaridad))
            $id_escolaridad = $trabajador -> adscripcion -> id_escolaridad;   

        global $criterio;
        $criterio = \Request::get('search');
        if(Auth::user() -> roles[0] -> rol_key == 'dir_general'){
            $informes = Informe::where('nombre', 'like', '%'.$criterio.'%')
                ->orwhere('email', 'like', '%'.$criterio.'%')
                ->orwhere('telefono', 'like', '%'.$criterio.'%')
                ->orwhere('asunto', 'like', '%'.$criterio.'%')
                ->orwhere('mensaje', 'like', '%'.$criterio.'%')
                ->sortable()
                ->orderBy('id')
                ->paginate(10);
        }else if(Auth::user() -> roles[0] -> rol_key == 'director'){
            $informes = Informe::where('id_escolaridad', $id_escolaridad)
            ->where(function($query){
                global $criterio;
                $query->where('nombre', 'like', '%'.$criterio.'%')
                ->orwhere('email', 'like', '%'.$criterio.'%')
                ->orwhere('telefono', 'like', '%'.$criterio.'%')
                ->orwhere('asunto', 'like', '%'.$criterio.'%')
                ->orwhere('mensaje', 'like', '%'.$criterio.'%');
            })
            ->sortable()
            ->orderBy('id')
            ->paginate(10);
        }

        return view('Informe.index',compact('informes'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $informe = Informe::findOrFail($id);
        return view('Informe.show', compact('informe'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }

    public function attend(Request $request)
    {
        //
        $informe = Informe::findOrFail($request -> id_informe);
        $estatus = 0;
        if( $informe -> atendido == 0 ){
            $informe -> atendido = 1;
            $informe -> save();
            $estatus = 1;
        }

        if($estatus == 1)
            return redirect()->route('Informe.index')->with('info','El Informe ha sido atendido.');
        else if($estatus == 0)
            return redirect()->route('Informe.index')->with('info','El Informe ya fue resuelto.');
    }
}
