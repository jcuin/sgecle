<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgendaRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\View;
use App\Charts\Genero2;
use App\Agenda;
use App\Setting;
use App\Trabajador;
use App\Grupo;
use DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*function __construct(){
        $this -> middleware(['auth', 'roles:dir_general,director,profesor']);
    }*/

    public function index()
    {
        //
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI
        
        $eventos = Agenda::where('evento', 'like', '%'.$criterio.'%')
        ->orwhere('id_periodo',$criterio)
        ->orwhere('id_escolaridad',$criterio)
        ->orwhere('descripcion',$criterio)
        ->orwhere('fecha_evento','like','%'.$criterio.'%')
        ->sortable()
        ->orderBy('id_agenda')
        ->paginate(10);
        
        return view('Agenda.index', compact('eventos'));
    }

    public function chart()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Agenda.create');
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
        $periodo_actual = Setting::first();
        $autor =  Auth::user() -> id_trabajador;       
        $escolaridad = Trabajador::findOrFail($autor)-> adscripcion -> id_escolaridad;
        
        $numero_guardado = 0;

        for ($i=0; $i < count($request -> evento) ; $i++) { 
            $agenda = new Agenda;
            $agenda -> id_periodo = $periodo_actual -> id_periodo;
            $agenda -> id_escolaridad = $escolaridad;
            $agenda -> evento = $request -> evento[$i];
            $agenda -> descripcion = $request -> descripcion[$i]; 
            $agenda -> fecha_evento = $request -> fecha_evento[$i];
            $agenda -> hora_inicio = $request -> hora_inicio[$i];
            $agenda -> hora_fin = $request -> hora_fin[$i];            
            $agenda -> save();

            $numero_guardado++;
        }

        if($numero_guardado == count($request -> evento))
            return redirect()->route('Agenda.index')->with('info','Evento(s) creado(s) con éxito.');
        else
            return redirect()->route('Agenda.index')->with('error','Imposible guardar Evento(s).');
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
        $evento = Agenda::findOrFail($id);

        $grupos = DB::table('cat_grupos')
                  ->join('cat_periodos', 'cat_grupos.id_periodo', '=', 'cat_periodos.id_periodo')
                  
                  ->select(DB::raw('COUNT(cat_grupos.id_grupo) as count, cat_periodos.periodo')) -> groupBy('cat_periodos.periodo') -> get() -> toArray();
        
        $etiquetas = array_column($grupos, 'periodo');
        $grupos = array_column($grupos, 'count');

        return view('Agenda.show', compact('evento', 'chart'))->with('grupos_por_periodo', json_encode($grupos, JSON_NUMERIC_CHECK))
            ->with('periodos', json_encode($etiquetas));
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
        $evento = Agenda::findOrFail($id);
        
        return view('Agenda.edit', compact('evento'));
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
        $evento = Agenda::findOrFail($id);

        $evento -> evento = $request -> evento;
        $evento -> descripcion = $request -> descripcion; 
        $evento -> fecha_evento = $request -> fecha_evento;
        $evento -> hora_inicio = $request -> hora_inicio;
        $evento -> hora_fin = $request -> hora_fin;            
        $guardado = $evento -> save();
        
        if($guardado)
            return redirect()->route('Agenda.index')->with('info','Evento actualizado con éxito.');
        else
            return redirect()->route('Agenda.index')->with('error','Imposible actualizar Evento.');
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
        $destruido = Agenda::destroy($id);

        if($destruido)
            return redirect()->route('Agenda.index')->with('info','Evento eliminado con éxito.');
        else
            return redirect()->route('Agenda.index')->with('error','Imposible borrar Evento.');
    }

    public function calendario()
    {
        //
        $periodo_actual = Setting::first();      
        $escolaridad = Trabajador::findOrFail(Auth::user() -> id_trabajador)-> adscripcion -> id_escolaridad;
        
        $eventos = Agenda::where('id_periodo', $periodo_actual -> id_periodo)
        -> where('id_escolaridad', $escolaridad)
        -> where('fecha_evento', '>=', date('Y-m-d H:i:s'))
        -> orderBy('fecha_evento') 
        -> get();
        
        
        return view('Agenda.calendario', compact('eventos'));
    }
}
