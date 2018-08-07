<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlaneacionRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Planeacion;
use App\Anexo;
use App\Propuesta;
use App\Setting;
use App\Periodo;
use App\Grupo;
use Illuminate\Support\Facades\Input;
use DateTime;
use DB;
use Validator;
 
class PlaneacionController extends Controller
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
        global $criterio;
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        if(Auth::user() -> roles[0] -> rol_key == 'dir_general'){
            $planeaciones = Planeacion::where('enviar', 1)
            ->where(function($query){
                global $criterio;
                $query->where('id_planeacion', 'like', '%'.$criterio.'%');
                $query->orwhere('id_trabajador', 'like', '%'.$criterio.'%');
                $query->orwhere('comentarios', 'like', '%'.$criterio.'%');
                $query->orwhere('enviado_el', 'like', '%'.$criterio.'%');
             })
            ->sortable()
            ->orderBy('enviado_el', 'desc')
            ->paginate(10);
        }else if(Auth::user() -> roles[0] -> rol_key == 'director'){
            $planeaciones = Planeacion::where('enviar', 1)
            ->where(function($query){
                global $criterio;
                $query->where('id_planeacion', 'like', '%'.$criterio.'%');
                $query->orwhere('id_trabajador', 'like', '%'.$criterio.'%');
                $query->orwhere('comentarios', 'like', '%'.$criterio.'%');
                $query->orwhere('enviado_el', 'like', '%'.$criterio.'%');
            })
            ->sortable()
            ->orderBy('enviado_el', 'desc')
            ->paginate(10);
        }else if(Auth::user() -> roles[0] -> rol_key == 'profesor'){
            $planeaciones = Planeacion::where('id_trabajador', Auth::user() -> id_trabajador)
            ->where(function($query){
                global $criterio;
                $query->where('comentarios', 'like', '%'.$criterio.'%');
                $query->orwhere('comentarios', null);  
            })
            ->sortable()
            ->orderBy('enviado_el', 'desc')
            ->paginate(10);
        }

        return view('Planeacion.index', compact('planeaciones'));
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
        $semanas = Periodo::findOrFail($periodo_actual -> id_periodo);
        $grupos = DB::table('cat_grupos')
                  ->join('materia_x_grupos', 'cat_grupos.id_grupo', '=', 'materia_x_grupos.id_grupo')
                  ->join('cat_materias', 'cat_materias.id_materia', '=', 'materia_x_grupos.id_materia')
                  ->where('materia_x_grupos.id_trabajador', Auth::user() -> id_trabajador)
                  ->where('cat_grupos.id_periodo', $periodo_actual -> id_periodo)
                  ->select('cat_grupos.id_grupo as id_grupo', 'cat_grupos.grupo as grupo', 'cat_materias.id_materia as id_materia', 'cat_materias.materia as materia') -> distinct() -> get();
        
        return view('Planeacion.create', compact('grupos', 'semanas'));
    }

    public function createAnual()
    {
        //
        $periodo_actual = Setting::first();
        $semanas = Periodo::findOrFail($periodo_actual -> id_periodo);
        $grupos = DB::table('cat_grupos')
                  ->join('materia_x_grupos', 'cat_grupos.id_grupo', '=', 'materia_x_grupos.id_grupo')
                  ->join('cat_materias', 'cat_materias.id_materia', '=', 'materia_x_grupos.id_materia')
                  ->where('materia_x_grupos.id_trabajador', Auth::user() -> id_trabajador)
                  ->where('cat_grupos.id_periodo', $periodo_actual -> id_periodo)
                  ->select('cat_grupos.id_grupo as id_grupo', 'cat_grupos.grupo as grupo', 'cat_materias.id_materia as id_materia', 'cat_materias.materia as materia') -> distinct() -> get();

        return view('Planeacion.createAnual', compact('grupos', 'semanas', 'periodo_actual'));
    }   
    public function createPropuesta($id)
    {
        $id_planeacion = $id;
        return view('Planeacion.createPropuesta', compact('id_planeacion'));
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaneacionRequest $request)
    {
        //
        $guardado = false;
        $setting = Setting::first();
        $grupo = Grupo::findOrFail($request -> grupo);
        //dd($grupo -> grupo);
        $numero_de_archivos = explode( '-',$request -> resumen_propuestas);
        for($i = 0; $i < count($numero_de_archivos); $i++){
            if($numero_de_archivos[$i] === '')
                unset($numero_de_archivos[$i]);
        }

        $statement = DB::select("SHOW TABLE STATUS LIKE 'planeaciones'");
        $maxplan = $statement[0]->Auto_increment;
        $trabajador = Auth::user() -> trabajador -> nombre.' '.Auth::user() -> trabajador -> a_paterno;
        $trabajador = str_replace(" ", "_", $trabajador);

        if($request -> hasFile('archivo')){
            $planeacion = new Planeacion;
            if($request -> anual == 0){
                $planeacion -> archivo = $request -> file('archivo') -> storeAs('public/planeaciones/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $maxplan.'_'.explode('.',$request -> file('archivo') -> getClientOriginalName())[0].'_planeacion.'.$request -> file('archivo') -> extension());
            }else{
                $planeacion -> archivo = $request -> file('archivo') -> storeAs('public/planeacionesAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $maxplan.'_'.explode('.',$request -> file('archivo') -> getClientOriginalName())[0].'_planeacion.'.$request -> file('archivo') -> extension());
                $planeacion -> semana = $request -> semana;
            }
            $planeacion -> comentarios = $request -> comentarios;
            $planeacion -> id_trabajador = Auth::user() -> id_trabajador;
            $planeacion -> id_grupo = $request -> grupo;
            $planeacion -> enviar = 0;           
            $planeacion -> anual = $request -> anual;
            $guardado = $planeacion -> save();
        }else{
            return redirect()->route('Planeacion.index')->with('error','Imposible crear una Planeación vacía.');
        }

        $maxid = DB::table('planeaciones')->max('id_planeacion');
        /*if( count(Input::file('anexo')) > 0){
            $contador = 0;
            foreach(Input::file('anexo') as $file){
                if($request -> num_copias[$contador] != null && $request -> fecha_de_uso[$contador] != null){
                    $anexo = new Anexo;
                    $anexo -> id_planeacion = $maxid;
                    $anexo -> archivo = $file -> storeAs('public/anexos', $maxid.'_'.$trabajador.'_anexo_'.$contador.'.'.$file->extension());
                    $anexo -> numero_copias = $request -> num_copias[$contador];
                    $anexo -> fecha_de_uso = $request -> fecha_de_uso[$contador];
                    $anexo -> save();
                    $contador = $contador + 1;
                }
            }
            $guardado = true;
        }*/

        if(count($request -> num_copias) > 0){
            for($i = 0; $i < count($request -> num_copias); $i++){
                if($request -> num_copias[$i] != null && $request -> fecha_de_uso[$i] != null){
                    $anexo = new Anexo;
                    $anexo -> id_planeacion = $maxid;
                    if($request -> hasFile('anexo.'.key($request -> anexo))){
                        if($request -> anual == 0){
                            $anexo -> archivo = $request -> anexo[$i] -> storeAs('public/anexos/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $maxid.'_'.explode('.',$request -> anexo[$i] -> getClientOriginalName())[0].'_anexo_'.($i+1).'.'.$request -> anexo[$i] -> extension());
                        }else{
                            $anexo -> archivo = $request -> anexo[$i] -> storeAs('public/anexosAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $maxid.'_'.explode('.',$request -> anexo[$i] -> getClientOriginalName())[0].'_anexo_'.($i+1).'.'.$request -> anexo[$i] -> extension());
                        }
                    }    
                    $anexo -> numero_copias = $request -> num_copias[$i];
                    $anexo -> fecha_de_uso = $request -> fecha_de_uso[$i];
                    $anexo -> save();
                }
            }
            $guardado = true;
        }

        $numero_de_archivos = explode( '-',$request -> resumen_propuestas);
        if(count($request -> fecha_de_uso2) > 0){
            for($i = 0; $i < count($request -> fecha_de_uso2); $i++){
                if($request -> fecha_de_uso2[$i] != null && $request -> detalles[$i] != null){
                    $propuesta = new Propuesta;
                    $propuesta -> id_planeacion = $maxid;
                    for($j = 0; $j < count($numero_de_archivos); $j++){
                        if(intval($numero_de_archivos[$j]) == $i){
                            if($request -> anual == 0){
                                $propuesta -> archivo = $request -> propuesta[intval($numero_de_archivos[$j])] -> storeAs('public/propuestas/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $maxid.'_'.$request -> propuesta[intval($numero_de_archivos[$j])] -> getClientOriginalName().'_propuesta_'.($i+1).'.'.$request -> propuesta[intval($numero_de_archivos[$j])] -> extension());
                            }else{
                                $propuesta -> archivo = $request -> propuesta[intval($numero_de_archivos[$j])] -> storeAs('public/propuestasAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $maxid.'_'.$request -> propuesta[intval($numero_de_archivos[$j])] -> getClientOriginalName().'_propuesta_'.($i+1).'.'.$request -> propuesta[intval($numero_de_archivos[$j])] -> extension());
                            }
                        }
                    }
                    $propuesta -> fecha_de_uso = $request -> fecha_de_uso2[$i];
                    $propuesta -> detalles = $request -> detalles[$i];
                    $propuesta -> save();
                }
            }
            $guardado = true;
        }

        if($guardado)
            return redirect()->route('Planeacion.index')->with('info','Planeación creada con éxito.');
        else
            return redirect()->route('Planeacion.index')->with('error','Imposible crear Planeación.');
    }
    public function storePropuesta(Request $request)
    {
        //
        //dd($request);
        $id = $request -> id_planeacion;
        $setting = Setting::first();
        $planeacion = Planeacion::findOrFail($request -> id_planeacion);
        $grupo = Grupo::findOrFail($planeacion -> id_grupo);

        $numero_de_archivos = explode( '-',$request -> resumen_propuestas);
        if(count($request -> fecha_de_uso) > 0){
            for($i = 0; $i < count($request -> fecha_de_uso); $i++){
                if($request -> fecha_de_uso[$i] != null && $request -> detalles[$i] != null){
                    $propuesta = new Propuesta;
                    $propuesta -> id_planeacion = $request -> id_planeacion;
                    for($j = 0; $j < count($numero_de_archivos); $j++){
                        if(intval($numero_de_archivos[$j]) == $i){
                            if($request -> anual == 0){
                                $propuesta -> archivo = $request -> propuesta[intval($numero_de_archivos[$j])] -> storeAs('public/propuestas/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.$request -> propuesta[intval($numero_de_archivos[$j])] -> getClientOriginalName().'_propuesta_'.($i+1).'.'.$request -> propuesta[intval($numero_de_archivos[$j])] -> extension());
                            }else{
                                $propuesta -> archivo = $request -> propuesta[intval($numero_de_archivos[$j])] -> storeAs('public/propuestasAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.$request -> propuesta[intval($numero_de_archivos[$j])] -> getClientOriginalName().'_propuesta_'.($i+1).'.'.$request -> propuesta[intval($numero_de_archivos[$j])] -> extension());
                            }
                        }
                    }
                    $propuesta -> fecha_de_uso = $request -> fecha_de_uso[$i];
                    $propuesta -> detalles = $request -> detalles[$i];
                    $propuesta -> save();
                }
            }
        }

        return redirect()->route('Planeacion.show', $request -> id_planeacion)->with('info','Propuesta creada con éxito.');
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
        $planeacion = Planeacion::findOrFail($id);
        if($planeacion -> nuevo == 1){
            $planeacion -> nuevo = 0;
            $planeacion -> save();    
        }
        
        $anexos = Anexo::where('id_planeacion', $id) -> get();
        $propuestas = Propuesta::where('id_planeacion', $id) -> get();

        return view('Planeacion.show', compact('planeacion', 'anexos', 'propuestas'));
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
    public function editPlaneacion($id)
    {
        //
        $periodo_actual = Setting::first();
        $semanas = Periodo::findOrFail($periodo_actual -> id_periodo);
        $planeacion = Planeacion::findOrFail($id);
        
        return view('Planeacion.editPlaneacion', compact('planeacion', 'semanas'));
    }
    public function editAnexo($id)
    {
        //
        $id_planeacion = $id;
        $anexos = Anexo::where('id_planeacion', $id) -> get();

        return view('Planeacion.editAnexo', compact('anexos', 'id_planeacion'));
    }
    public function editPropuesta($id)
    {
        //
        $id_planeacion = $id;
        $propuestas = Propuesta::where('id_planeacion', $id) -> get();

        return view('Planeacion.editPropuesta', compact('propuestas', 'id_planeacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaneacionRequest $request, $id)
    {
        //
        
    }
    public function updatePlaneacion(Request $request)
    {
        // 
        $planeacion = Planeacion::findOrFail($request -> id_planeacion);
        $setting = Setting::first();
        $grupo = Grupo::findOrFail($planeacion -> id_grupo);
        
        if($request -> hasFile('archivo')){
            Storage::delete($planeacion -> archivo);
            if($planeacion -> anual == 0){
                $planeacion -> archivo = $request -> file('archivo') -> storeAs('public/planeaciones/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $planeacion -> id_planeacion.'_'.explode('.',$request -> file('archivo') -> getClientOriginalName())[0].'_planeacion.'.$request -> file('archivo') -> extension());
            }else{
                $planeacion -> archivo = $request -> file('archivo') -> storeAs('public/planeacionesAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $planeacion -> id_planeacion.'_'.explode('.',$request -> file('archivo') -> getClientOriginalName())[0].'_planeacion.'.$request -> file('archivo') -> extension());
            }
        }
        
        $planeacion -> comentarios = $request -> comentarios;
        $planeacion -> semana = $request -> semana;          
        $planeacion -> save();

        return redirect()->route('Planeacion.index')->with('info','Planeación actualizada con éxito.');
    }
    public function updateAnexo(Request $request)
    {
        // 
        $id = $request -> id_planeacion;
        $planeacion = Planeacion::findOrFail($id);
        $setting = Setting::first();
        $grupo = Grupo::findOrFail($planeacion -> id_grupo);

        //cambios en el archivo de los ya registrados
        $resumen_propuestas = explode('-',$request -> resumen_propuestas);
        $resumen_propuestas = array_filter($resumen_propuestas, 'strlen');
        $archivos = array();
        for($i = 0; $i < count($request -> numero_copias); $i++){
            if(isset($request -> anexo_archivo[$i])){
                array_push($archivos, $i);
            }
        }
        if(count($resumen_propuestas) > 0){
            for($i = 0; $i < count($resumen_propuestas); $i++){
                $anexo = Anexo::findOrFail($resumen_propuestas[$i]);
                Storage::delete($anexo -> archivo[intval($archivos[$i])]);
                if($planeacion -> anual == 0)
                    $anexo -> archivo = $request -> anexo_archivo[intval($archivos[$i])] -> storeAs('public/anexos/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.explode('.',$request -> anexo_archivo[intval($archivos[$i])] -> getClientOriginalName())[0].'_anexo_'.($i+1).'.'.$request -> anexo_archivo[intval($archivos[$i])] -> extension());
                else
                    $anexo -> archivo = $request -> anexo_archivo[intval($archivos[$i])] -> storeAs('public/anexosAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.explode('.',$request -> anexo_archivo[intval($archivos[$i])] -> getClientOriginalName())[0].'_anexo_'.($i+1).'.'.$request -> anexo_archivo[intval($archivos[$i])] -> extension());
                $anexo -> numero_copias = $request -> numero_copias[$i];
                $anexo -> fecha_de_uso = $request -> fecha_de_uso[$i];
                $anexo -> save();
            }
        }

        //sin cambios en el archivo, sólo en el texto
        for($i = 0; $i < count($request -> id_oculto); $i++){
            $anexo = Anexo::findOrFail($request -> id_oculto[$i]);
            $anexo -> numero_copias = $request -> numero_copias[$i];
            $anexo -> fecha_de_uso = $request -> fecha_de_uso[$i];
            $anexo -> save();
        }
        
        //registro de los nuevos
        $nuevos_anexos = $request -> anexo_nuevo_numero_copias;
        $nuevos_archivos = explode('-',$request -> resumen_nuevas_propuestas);
        $nuevos_archivos = array_filter($nuevos_archivos, 'strlen');
        if(isset($nuevos_archivos[0]) && $nuevos_archivos[0] != null){
            if(count($nuevos_anexos) > 0){
                for($i = 1; $i < count($nuevos_anexos); $i++){
                    if($request -> file('anexo_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) != null){
                        $anexo = new Anexo;
                        $anexo -> id_planeacion = $id;
                        if($planeacion -> anual == 0)
                            $anexo -> archivo = $request -> file('anexo_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> storeAs('public/anexos/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.explode('.',$request -> file('anexo_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> getClientOriginalName())[0].'_anexo_'.($i+1).'.'.$request -> file('anexo_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> extension());
                        else
                            $anexo -> archivo = $request -> file('anexo_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> storeAs('public/anexosAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.explode('.',$request -> file('anexo_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> getClientOriginalName())[0].'_anexo_'.($i+1).'.'.$request -> file('anexo_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> extension());
                        $anexo -> numero_copias = $request -> anexo_nuevo_numero_copias[$i];
                        $anexo -> fecha_de_uso = $request -> anexo_nuevo_fecha_uso[$i];
                        $anexo -> save();
                    }
                }
            }
        }

        //borrados
        if($request -> resumen_borrados[0] != null){
            $resumen_borrados = explode( '-',$request -> resumen_borrados);
            $resumen_borrados = array_filter($resumen_borrados, 'strlen');
            if(count($resumen_borrados) > 0){
                for($i = 0; $i < count($resumen_borrados); $i++){
                    $anexo = Anexo::findOrFail($resumen_borrados[$i]);
                    Storage::delete($anexo -> archivo);
                    $anexo = Anexo::destroy($resumen_borrados[$i]);
                }
            }
        }

        return redirect() -> route('Planeacion.show', compact('id')) -> with('info','Anexos actualizados con éxito.');
    }
    public function updatePropuesta(Request $request)
    {
        //
        $id = $request -> id_planeacion;
        $planeacion = Planeacion::findOrFail($id);
        $setting = Setting::first();
        $grupo = Grupo::findOrFail($planeacion -> id_grupo);

        //cambios en el archivo de los ya registrados
        $resumen_propuestas = explode('-',$request -> resumen_propuestas);
        $resumen_propuestas = array_filter($resumen_propuestas, 'strlen');
        $archivos = array();
        for($i = 0; $i < count($request -> fecha_de_uso); $i++){
            if(isset($request -> propuesta_archivo[$i])){
                array_push($archivos, $i);
            }
        }
        //dd(count($resumen_propuestas));
        if(count($resumen_propuestas) > 0){
            for($i = 0; $i < count($resumen_propuestas); $i++){
                $propuesta = Propuesta::findOrFail($resumen_propuestas[$i]);
                Storage::delete($propuesta -> archivo[intval($archivos[$i])]);
                if($planeacion -> anual == 0)
                    $propuesta -> archivo = $request -> propuesta_archivo[intval($archivos[$i])] -> storeAs('public/propuestas/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.explode('.',$request -> propuesta_archivo[intval($archivos[$i])] -> getClientOriginalName())[0].'_propuesta_'.($i+1).'.'.$request -> propuesta_archivo[intval($archivos[$i])] -> extension());
                else
                    $propuesta -> archivo = $request -> propuesta_archivo[intval($archivos[$i])] -> storeAs('public/propuestasAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.explode('.',$request -> propuesta_archivo[intval($archivos[$i])] -> getClientOriginalName())[0].'_propuesta_'.($i+1).'.'.$request -> propuesta_archivo[intval($archivos[$i])] -> extension());
                $propuesta -> fecha_de_uso = $request -> fecha_de_uso[$i];
                $propuesta -> detalles = $request -> detalles[$i];
                $propuesta -> save();
            }
        }

        //sin cambios en el archivo, sólo en el texto
        for($i = 0; $i < count($request -> id_oculto); $i++){
            $propuesta = Propuesta::findOrFail($request -> id_oculto[$i]);
            $propuesta -> fecha_de_uso = $request -> fecha_de_uso[$i];
            $propuesta -> detalles = $request -> detalles[$i];
            $propuesta -> save();
        }
        
        //registro de los nuevos
        $nuevas_propuestas = $request -> propuesta_nuevo_fecha_uso;
        $nuevos_archivos = explode('-',$request -> resumen_nuevas_propuestas);
        $nuevos_archivos = array_filter($nuevos_archivos, 'strlen');
        if(isset($nuevos_archivos[0]) && $nuevos_archivos[0] != null){
            if(count($nuevas_propuestas) > 0){
                for($i = 1; $i < count($nuevas_propuestas); $i++){
                    if($request -> file('propuesta_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) != null){
                        $propuesta = new Propuesta;
                        $propuesta -> id_planeacion = $id;
                        if($planeacion -> anual == 0)
                            $propuesta -> archivo = $request -> file('propuesta_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> storeAs('public/propuestas/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.explode('.',$request -> file('propuesta_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> getClientOriginalName())[0].'_propuesta_'.($i+1).'.'.$request -> file('propuesta_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> extension());
                        else
                            $propuesta -> archivo = $request -> file('propuesta_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> storeAs('public/propuestasAnual/'.$setting -> periodo -> periodo.'/'.$grupo -> grupo, $id.'_'.explode('.',$request -> file('propuesta_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> getClientOriginalName())[0].'_propuesta_'.($i+1).'.'.$request -> file('propuesta_nuevo_archivo_'.strval($nuevos_archivos[$i-1])) -> extension());
                        $propuesta -> fecha_de_uso = $request -> propuesta_nuevo_fecha_uso[$i];
                        $propuesta -> detalles = $request -> propuesta_nuevos_detalles[$i];
                        $propuesta -> save();
                    }
                }
            }
        }

        //borrados
        if($request -> resumen_borrados[0] != null){
            $resumen_borrados = explode( '-',$request -> resumen_borrados);
            $resumen_borrados = array_filter($resumen_borrados, 'strlen');
            if(count($resumen_borrados) > 0){
                for($i = 0; $i < count($resumen_borrados); $i++){
                    $propuesta = Propuesta::findOrFail($resumen_borrados[$i]);
                    Storage::delete($propuesta -> archivo);
                    $propuesta = Propuesta::destroy($resumen_borrados[$i]);
                }
            }
        }

        return redirect() -> route('Planeacion.show', compact('id')) -> with('info','Propuestas actualizadas con éxito.');
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
        $planeacion = Planeacion::findOrFail($id);
        Storage::delete($planeacion -> archivo);

        $anexos = Anexo::where('id_planeacion', $id) -> get();
        foreach ($anexos as $anexo) {
            Storage::delete($anexo -> archivo);  
            Anexo::destroy($anexo -> id_anexo);
        }

        $propuestas = Propuesta::where('id_planeacion', $id) -> get();
        foreach ($propuestas as $propuesta) {
            Storage::delete($propuesta -> archivo);  
            Propuesta::destroy($propuesta -> id_anexo);
        }
        Planeacion::destroy($id);

        return redirect()->route('Planeacion.index')->with('info','Planeación, anexos y propuestas eliminados con éxito.');
    }

    public function downloadFile($id){
        $parametros = explode('-',$id);
        if($parametros[1] == 1)
            $archivo = Planeacion::findOrFail($parametros[0]);
        else if($parametros[1] == 2)
            $archivo = Anexo::findOrFail($parametros[0]);
        else
            $archivo = Propuesta::findOrFail($parametros[0]);

        $download_path = ( public_path() .Storage::url( $archivo -> archivo ) );
        
        return response()->download($download_path);
    }   

    public function send(Request $request)
    {
        //
        $planeacion = Planeacion::findOrFail($request -> id_planeacion);
        $estatus = 0;
        if( $planeacion -> enviar == 0){
            $planeacion -> enviar = 1;
            $planeacion -> enviado_el = new DateTime();
            if( $planeacion -> anual == 0){
                if(date('Y-m-d H:i:s') <= date ("Y-m-d H:i:s", strtotime("+ 3 day + 11 hours + 30 minutes", strtotime($planeacion -> semana)))) {
                    $planeacion -> semaforo = 'Morado';
                }else if(date('Y-m-d H:i:s') <= date ("Y-m-d H:i:s", strtotime("+ 3 day + 23 hours + 59 minutes", strtotime($planeacion -> semana)))) {
                    $planeacion -> semaforo = 'Verde';
                }else if(date('Y-m-d H:i:s') <= date ("Y-m-d H:i:s", strtotime("+ 4 day + 11 hours + 30 minutes", strtotime($planeacion -> semana)))) {
                    $planeacion -> semaforo = 'Amarillo';
                }else if(date('Y-m-d H:i:s') <= date ("Y-m-d H:i:s", strtotime("+ 4 day + 23 hours + 59 minutes", strtotime($planeacion -> semana)))) {
                    $planeacion -> semaforo = 'Rojo';
                }else{
                    $planeacion -> semaforo = 'Rojo';
                }
            }
            $estatus = 1;
        }
        $planeacion -> save();

        if($estatus == 0)
            return redirect()->route('Planeacion.index')->with('info','Su Planeación no ha podido ser enviada.');
        else if($estatus == 1)
            return redirect()->route('Planeacion.index')->with('info','Su Planeación ha sido enviada con éxito.');
    }

    public function estadistica($id)
    {
        //
        $setting = Setting::first();

        $semaforo = DB::select(DB::raw("select trabajador.periodo as periodo, trabajador.id, trabajador.nombre, coalesce(sem_rojos,'0') as Tarde, coalesce(sem_amarillos,'0') as Antes_de_Vencimiento, coalesce(sem_verdes,'0') as A_Tiempo, coalesce(sem_morados,'0') as Anticipado
from
(select distinct (trabajadors.id_trabajador) as id, concat(trabajadors.nombre,' ',trabajadors.a_paterno,' ',trabajadors.a_materno) as nombre, cat_grupos.id_periodo as periodo
from trabajadors
inner join planeaciones
on planeaciones.id_trabajador=trabajadors.id_trabajador
inner join cat_grupos
on cat_grupos.id_grupo=planeaciones.id_grupo
where cat_grupos.id_periodo =:id_periodo) as trabajador


left join 
(select cat_periodos.id_periodo as periodor, planeaciones.id_trabajador as trabro, trabajadors.nombre, trabajadors.a_paterno, trabajadors.a_materno, count(planeaciones.id_trabajador) as sem_rojos, planeaciones.semaforo
from planeaciones
inner join cat_grupos
on cat_grupos.id_grupo=planeaciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo=cat_grupos.id_periodo
inner join trabajadors
on trabajadors.id_trabajador=planeaciones.id_trabajador
and planeaciones.semaforo='Rojo'
group by semaforo, planeaciones.id_trabajador) as rojos

on trabajador.id=trabro
and trabajador.periodo=periodor

left join 
(select cat_periodos.id_periodo as periodoa, planeaciones.id_trabajador as trabam, trabajadors.nombre, trabajadors.a_paterno, trabajadors.a_materno, count(planeaciones.id_trabajador) as sem_amarillos, planeaciones.semaforo
from planeaciones
inner join cat_grupos
on cat_grupos.id_grupo=planeaciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo=cat_grupos.id_periodo
inner join trabajadors
on trabajadors.id_trabajador=planeaciones.id_trabajador
and planeaciones.semaforo='Amarillo'
group by semaforo, planeaciones.id_trabajador) as amarillos

on trabajador.id=trabam
and trabajador.periodo=periodoa


left join 
(select cat_periodos.id_periodo as periodov, planeaciones.id_trabajador as trabve, trabajadors.nombre, trabajadors.a_paterno, trabajadors.a_materno, count(planeaciones.id_trabajador) as sem_verdes, planeaciones.semaforo
from planeaciones
inner join cat_grupos
on cat_grupos.id_grupo=planeaciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo=cat_grupos.id_periodo
inner join trabajadors
on trabajadors.id_trabajador=planeaciones.id_trabajador
and planeaciones.semaforo='Verde'
group by semaforo, planeaciones.id_trabajador) as verdes

on trabajador.id=trabve
and trabajador.periodo=periodov

left join 
(select cat_periodos.id_periodo as periodom, planeaciones.id_trabajador as trabmo, trabajadors.nombre, trabajadors.a_paterno, trabajadors.a_materno, count(planeaciones.id_trabajador) as sem_morados, planeaciones.semaforo
from planeaciones
inner join cat_grupos
on cat_grupos.id_grupo=planeaciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo=cat_grupos.id_periodo
inner join trabajadors
on trabajadors.id_trabajador=planeaciones.id_trabajador
and planeaciones.semaforo='Morado'
group by semaforo, planeaciones.id_trabajador) as morados

on trabajador.id=trabmo
and trabajador.periodo=periodom order by nombre"),  array('id_periodo' => $setting -> id_periodo));

        $etiquetas = array_column($semaforo, 'nombre');

        $rojo = array_column($semaforo, 'Tarde');
        $amarillo = array_column($semaforo, 'Antes_de_Vencimiento');
        $verde = array_column($semaforo, 'A_Tiempo');
        $morado = array_column($semaforo, 'Anticipado');

        return view('Planeacion.estadistica')
            ->with('etiquetas', json_encode($etiquetas))
            ->with('rojo', json_encode($rojo, JSON_NUMERIC_CHECK))
            ->with('amarillo', json_encode($amarillo, JSON_NUMERIC_CHECK))
            ->with('verde', json_encode($verde, JSON_NUMERIC_CHECK))
            ->with('morado', json_encode($morado, JSON_NUMERIC_CHECK));
    }
}
