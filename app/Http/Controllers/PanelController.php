<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripcion;
use App\Notificacion;
use Auth;
use DB;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*function __construct(){
        $this -> middleware(['auth', 'roles:dir_general,director,profesor,administrativo,alumno']);
    }*/
    
    public function index()
    {
        //
        $id;
        $mensajes_roles = null;
        $mensajes_grupales = null;
        $mensajes_individuales = null;
        $periodo = DB::table('cat_periodos')
            ->join('settings', 'cat_periodos.id_periodo', '=', 'settings.id_periodo')
            ->select('periodo') 
            ->first();

        $grupos = DB::table('cat_grupos')
            ->join('settings', 'cat_grupos.id_periodo', '=', 'settings.id_periodo')
            ->select(DB::raw('count(cat_grupos.id_grupo) as grupos')) 
            ->first(); 

        $matricula = DB::table('inscripciones')
            ->select(DB::raw('count(DISTINCT id_alumno) as inscritos'))
            ->first();

        if( Auth::user() -> id_alumno != null ){
            $id = Auth::user() -> id_alumno;
            $mensajes_grupales = DB::table('notificaciones')
                    ->join('inscripciones', function ($join) use($id) {
                        $join->on('inscripciones.id_grupo', '=', 'notificaciones.id_grupo')
                             ->on('inscripciones.id_materia', '=', 'notificaciones.id_materia')
                             ->where('notificaciones.caducidad', '>=', date("Y-m-d"))
                             ->where('inscripciones.id_alumno', '=', $id);
                    })
                    ->join('trabajadors', function ($join) use($id) {
                        $join->on('notificaciones.id_trabajador_emisor', '=', 'trabajadors.id_trabajador')
                            ->where('notificaciones.publicar', '=', '1');
                    })
                    ->groupBy('notificaciones.id_grupo')
                    ->groupBy('notificaciones.id_materia')
                    ->groupBy('notificaciones.mensaje')
                    ->groupBy('trabajadors.nombre')
                    ->groupBy('trabajadors.a_paterno')
                    ->orderBy('notificaciones.created_at')
                    ->select('notificaciones.mensaje', 'trabajadors.nombre as nombre', 'trabajadors.a_paterno as a_paterno')
                    ->distinct()
                    ->get();

            $mensajes_individuales = Notificacion::where('caducidad', '>=', date("Y-m-d"))
                                ->where('id_alumno', $id)
                                ->where('publicar', '=', '1')
                                ->get();
        }else if( Auth::user() -> id_trabajador != null ){
            $id = Auth::user() -> id_trabajador;
            $mensajes_individuales = Notificacion::where('caducidad', '>=', date("Y-m-d"))
                                ->where('id_trabajador_destino', $id)
                                ->where('id_alumno', '=', null)
                                ->where('publicar', '=', '1')
                                ->get();
            $mensajes_alumnos = Notificacion::where('caducidad', '>=', date("Y-m-d"))
                                ->where('id_trabajador_destino', $id)
                                ->where('id_alumno', '!=', null)
                                ->where('publicar', '=', '1')
                                ->get();                   
            $mensajes_roles = Notificacion::where('caducidad', '>=', date("Y-m-d"))
                                ->where('id_rol', Auth::user() -> roles[0] -> id_rol)
                                ->where('publicar', '=', '1')
                                ->get();
        }

        if(Auth::user() -> roles[0] -> rol_key == 'director' || Auth::user() -> roles[0] -> rol_key == 'dir_general'){
            $colaboradores = DB::table('trabajadors')
                            ->select(DB::raw('count(id_trabajador) as trabajadores')) 
                            ->first(); 

            return view('Panel.index', compact('matricula', 'grupos', 'periodo', 'mensajes_individuales', 'mensajes_roles', 'colaboradores'));
        }else if(Auth::user() -> roles[0] -> rol_key == 'profesor'){
            return view('Panel.index_profesor', compact('matricula', 'grupos', 'periodo', 'mensajes_grupales', 'mensajes_individuales', 'mensajes_alumnos', 'mensajes_roles'));
        }else if(Auth::user() -> roles[0] -> rol_key == 'alumno'){
            return view('Panel.index_alumno', compact('matricula', 'grupos', 'periodo', 'mensajes_grupales', 'mensajes_individuales'));
        }
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
}
