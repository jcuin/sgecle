<?php

namespace App\Http\Controllers;

use App\Notificacion;
use Illuminate\Http\Request;
use App\Http\Requests\NotificacionRequest;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use App\Trabajador;
use DB;

class NotificacionController extends Controller
{
    /*function __construct(){
        $this -> middleware(['auth', 'roles:dir_general,director,profesor']);
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        global $criterio;
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        if(Auth::user() -> roles[0] -> rol_key == 'dir_general'){
            $notificaciones = Notificacion::where('id_notificacion', 'like', '%'.$criterio.'%')
            ->orwhere('id_trabajador_emisor', 'like', '%'.$criterio.'%')
            ->orwhere('mensaje', 'like', '%'.$criterio.'%')
            ->sortable()
            ->orderBy('id_notificacion')
            ->paginate(10);
        }else if(Auth::user() -> roles[0] -> rol_key == 'director'){
            $notificaciones = Notificacion::where('id_notificacion', 'like', '%'.$criterio.'%')
            ->orwhere('id_trabajador_emisor', 'like', '%'.$criterio.'%')
            ->orwhere('mensaje', 'like', '%'.$criterio.'%')
            ->sortable()
            ->orderBy('id_notificacion')
            ->paginate(10);
        }else if(Auth::user() -> roles[0] -> rol_key == 'profesor'){
            $notificaciones = Notificacion::where('id_trabajador_emisor', Auth::user() -> id_trabajador)
            ->where(function($query){
                global $criterio;
                $query->where('mensaje', 'like', '%'.$criterio.'%');  
            })
            ->sortable()
            ->orderBy('id_notificacion')
            ->paginate(10);
        }
        return view('Notificacion.index', compact('notificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $periodo_actual = Setting::first();
        $periodo_actual = $periodo_actual -> id_periodo;
        $trabajador_emisor =  Auth::user() -> id_trabajador;       
        $trabajador = Trabajador::findOrFail($trabajador_emisor);
        $id_escolaridad = $trabajador -> adscripcion -> id_escolaridad;
        $escolaridad = $trabajador -> adscripcion -> escolaridad;
        $usuario =  Auth::user();
        
        return view('Notificacion.create', compact('periodo_actual', 'trabajador_emisor', 'usuario', 'id_escolaridad', 'escolaridad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificacionRequest $request)
    {
        //
        $numero_guardado = 0;
        $total_a_guardar = 0;
        if( count($request -> grupos) > 0 ){
            $total_a_guardar = count($request -> grupos);
            foreach ($request -> grupos as $grupo) {
                $notificacion = new Notificacion;
                $notificacion -> id_trabajador_emisor = $request -> id_trabajador;
                $grupos_individuales = explode('-', $grupo);
                $notificacion -> id_grupo = $grupos_individuales[0];
                $notificacion -> id_materia = $grupos_individuales[1];
                $notificacion -> mensaje = $request -> mensaje;
                $notificacion -> caducidad = $request -> caducidad;
                $notificacion -> publicar = 0;
                $notificacion -> save();
                $numero_guardado++;
            }
        }else if( count($request -> alumnos) > 0){
            $total_a_guardar = count($request -> alumnos);
            foreach ($request -> alumnos as $alumno) {
                if( isset($request -> copiar_maestro) ){
                    if( count($request-> trabajadores2) > 0 ){
                        foreach($request -> trabajadores2 as $trabajador) {
                            $notificacion = new Notificacion;
                            $notificacion -> id_trabajador_emisor = $request -> id_trabajador;
                            $notificacion -> id_trabajador_destino = $trabajador;
                            $notificacion -> id_alumno = $alumno;
                            $notificacion -> mensaje = $request -> mensaje;
                            $notificacion -> caducidad = $request -> caducidad;
                            $notificacion -> publicar = 0;
                            $notificacion -> save();
                        }
                    }else{
                        $notificacion = new Notificacion;
                        $notificacion -> id_trabajador_emisor = $request -> id_trabajador;
                        $notificacion -> id_alumno = $alumno;
                        $notificacion -> mensaje = $request -> mensaje;
                        $notificacion -> caducidad = $request -> caducidad;
                        $notificacion -> publicar = 0;
                        $notificacion -> save();
                    }
                }else{
                        $notificacion = new Notificacion;
                        $notificacion -> id_trabajador_emisor = $request -> id_trabajador;
                        $notificacion -> id_alumno = $alumno;
                        $notificacion -> mensaje = $request -> mensaje;
                        $notificacion -> caducidad = $request -> caducidad;
                        $notificacion -> publicar = 0;
                        $notificacion -> save();
                }
                $numero_guardado++;
            }
        }else if( count($request -> trabajadores) > 0){
            $total_a_guardar = count($request -> trabajadores);
            foreach ($request -> trabajadores as $trabajador) {
                $notificacion = new Notificacion;
                $notificacion -> id_trabajador_emisor = $request -> id_trabajador;
                $notificacion -> id_trabajador_destino = $trabajador;
                $notificacion -> mensaje = $request -> mensaje;
                $notificacion -> caducidad = $request -> caducidad;
                $notificacion -> publicar = 0;
                $notificacion -> save();
                $numero_guardado++;
            }
        }else if( count($request -> roles) > 0){
            $total_a_guardar = count($request -> roles);
            foreach ($request -> roles as $rol) {
                $notificacion = new Notificacion;
                $notificacion -> id_trabajador_emisor = $request -> id_trabajador;
                $notificacion -> id_rol = $rol;
                $notificacion -> mensaje = $request -> mensaje;
                $notificacion -> caducidad = $request -> caducidad;
                $notificacion -> publicar = 0;
                $notificacion -> save();
                $numero_guardado++;
            }
        }
        
        if($total_a_guardar == $numero_guardado)
            return redirect()->route('Notificacion.index')->with('info','Notificación creada con éxito.');
        else
            return redirect()->route('Notificacion.index')->with('error','Imposible guardar Notificación.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $notificacion = Notificacion::findOrFail($id);
       
        return view('Notificacion.show', compact('notificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $notificacion = Notificacion::findOrFail($id);
        $periodo_actual = Setting::first();
        $periodo_actual = $periodo_actual -> id_periodo;
        $trabajador_emisor =  $notificacion -> id_trabajador_emisor;
        $usuario =  Auth::user();
       
        return view('Notificacion.edit', compact('notificacion', 'periodo_actual', 'trabajador_emisor', 'usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(NotificacionRequest $request, $id)
    {
        //
        $notificacion = Notificacion::findOrFail($id);
        $notificacion -> mensaje = $request -> mensaje;
        $notificacion -> caducidad = $request -> caducidad;
        $guardado = $notificacion -> save();
        
        if($guardado)
            return redirect()->route('Notificacion.index')->with('info','Notificación actualizada con éxito.');
        else
            return redirect()->route('Notificacion.index')->with('error','Imposible actualizar Notificación.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $destruido = Notificacion::destroy($id);
        
        if($destruido)
            return redirect()->route('Notificacion.index')->with('info','Notificación eliminada con éxito.');
        else
            return redirect()->route('Notificacion.index')->with('error','Imposible eliminar Notificación.');
    }

    public function publish(Request $request)
    {
        //
        $notificacion = Notificacion::findOrFail($request -> id_notificacion);
        $estatus = 0;
        if( $notificacion -> publicar == 1 ){
            $notificacion -> publicar = 0;
            $estatus = 0;
        }else if( $notificacion -> publicar == 0 ){
            $notificacion -> publicar = 1;
            $estatus = 1;
        }
        $notificacion -> save();

        if($estatus == 0)
            return redirect()->route('Notificacion.index')->with('info','Su Notificación ha sido suspendida.');
        else if($estatus == 1)
            return redirect()->route('Notificacion.index')->with('info','Su Notificación ha sido publicada.');
    }
}
