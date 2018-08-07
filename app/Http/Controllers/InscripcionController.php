<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InscipcionRequest;
use App\Inscripcion;
use App\Grupo;
use App\Alumno;
use App\Materia;
use \PDF;
use DB;

class InscripcionController extends Controller
{
    //
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
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI  

        if(substr(auth()->user()->roles[0]->rol_key,0,3) === "dir"){
            $grupos = DB::table('cat_grupos')
                    ->join('settings', 'cat_grupos.id_periodo', '=', 'settings.id_periodo')
                    ->where('id_grupo', $criterio)
                    ->orwhere('grupo','like', '%'.$criterio.'%')
                    ->select('cat_grupos.*')
                    ->paginate(10);
        }else{
            $grupos = DB::table('cat_grupos')
                    ->join('settings', 'cat_grupos.id_periodo', '=', 'settings.id_periodo')
                    ->join('materia_x_grupos', function ($join) {
                        $join->on('materia_x_grupos.id_grupo', '=', 'cat_grupos.id_grupo')
                         ->where('materia_x_grupos.id_trabajador', '=',auth()->user()->id_user);
                    })
                    ->where('cat_grupos.id_grupo', $criterio)
                    ->orwhere('grupo','like', '%'.$criterio.'%')
                    ->select('cat_grupos.*')
                    ->groupBy('cat_grupos.id_grupo')
                    ->groupBy('cat_grupos.grupo')
                    ->groupBy('cat_grupos.capacidad')
                    ->groupBy('cat_grupos.created_at')
                    ->groupBy('cat_grupos.updated_at')
                    ->groupBy('cat_grupos.id_periodo')
                    ->groupBy('cat_grupos.id_escolaridad')
                    ->paginate(10);
        }

        $inscritos_por_grupo = DB::table('inscripciones')
                     ->select(DB::raw('count( DISTINCT id_alumno) as inscritos, id_grupo'))
                     ->groupBy('id_grupo')
                     ->get();     
          
        $inscripciones = Inscripcion::where('id_grupo', 'like', '%'.$criterio.'%')
                        ->sortable()
                        ->orderBy('id_grupo')
                        ->paginate(10);

        return view('Inscripcion.index',compact('inscripciones', 'grupos', 'inscritos_por_grupo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Inscripcion.create');
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
        $exitosas = 0;
        $grupo = Grupo::findOrFail($request -> grupo);
        dd($grupo -> escolaridad() -> escolaridad);
        $materias = $grupo -> materias() -> get();
        if(count($request -> alumnos) <= $grupo -> capacidad){
            foreach ($materias as $materia) {
                for($i = 0; $i < count($request -> alumnos); $i ++){
                    
                        $inscripcion = new Inscripcion;
                        $inscripcion -> id_grupo = $request -> grupo;
                        $inscripcion -> id_materia = $materia -> id_materia;
                        $inscripcion -> id_alumno = $request -> alumnos[$i];
                        $inscripcion -> bimestre_trimestre =  1;
                        $inscripcion -> save();
                        $exitosas++;
                    
                }
            }

            $totales = count($materias) * count($request -> alumnos);
            if($exitosas == $totales)
                return redirect()->route('Inscripcion.index')->with('info','Inscripciones realizadas con éxito.');
            else
                return redirect()->route('Inscripcion.index')->with('error','Imposible realizar Inscripciones.');
        }else{
            return redirect()->route('Inscripcion.index')->with('error','El cupo del grupo es insuficiente. Imposible realizar inscripciones');
        }
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
        $grupo = Grupo::findOrFail($id);
        $inscripciones = Inscripcion::where('id_grupo', '=', $grupo -> id_grupo) -> get();
        $materias = $grupo -> materias() -> get();
        $alumnos = Alumno::orderBy('nombre')->paginate(50);
        
        return view('Inscripcion.show', compact('grupo', 'alumnos', 'materias', 'inscripciones'));
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
        $inscripcion = Inscripcion::findOrFail($id);
        return view('Inscripcion.edit', compact('Inscripcion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InscripcionRequest $request, $id)
    {
        //
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion -> Inscripcion = $request -> Inscripcion;
        $inscripcion -> capacidad = $request -> capacidad;
        $guardado = $inscripcion -> save();
        if($guardado)
            return redirect()->route('Inscripcion.index')->with('info','Inscripcion actualizado con éxito.');
        else
            return redirect()->route('Inscripcion.index')->with('error','Imposible actualizar Inscripcion.');
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
        $destruido = Inscripcion::destroy($id);
        if($destruido)
            return redirect()->route('Inscripcion.index')->with('info','Inscripcion eliminado con éxito.');
        else
            return redirect()->route('Inscripcion.index')->with('error','Imposible borrar Inscripcion.');
    }

    public function listarGrupo($id)
    {
        //
        $grupo = Grupo::findOrFail($id);
    
        $alumnos = DB::table('alumnos')
            ->join('inscripciones', 'inscripciones.id_alumno', '=', 'alumnos.id_alumno')
            ->join('cat_grupos', 'inscripciones.id_grupo', '=', 'cat_grupos.id_grupo')
            ->where('inscripciones.id_grupo', '=', $grupo -> id_grupo)
            ->select('alumnos.nombre', 'alumnos.a_paterno', 'alumnos.a_materno') -> distinct()
            ->orderBy('alumnos.nombre')
            ->get();

        return view('Inscripcion.list', compact('grupo', 'alumnos'));
    }

    public function boletaGrupo($id)
    {
        //
        $grupo = Grupo::findOrFail($id);
        $escolaridad = $grupo -> escolaridad -> escolaridad;
        
        if(substr( $escolaridad, 0, 4 ) === "Pres")
            return redirect()->route('Inscripcion.index')->with('info','Funcionalidad por definir para Prescolar.');

        $periodo = $grupo -> periodo -> periodo;
    
        $boletas = DB::select(DB::raw("select id_alumno, nombre, a_paterno, a_materno, curp, id_grupo, grupo, id_materia, materia, promediobt1, numero_inasistencias1, promediobt2, numero_inasistencias2, promediobt3, numero_inasistencias3, promediobt4, numero_inasistencias4, promediobt5, numero_inasistencias5
from
(select alumnos.nombre as nombre, alumnos.a_paterno as a_paterno, alumnos.a_materno as a_materno, alumnos.curp as curp, inscripciones.id_grupo as id_grupo, cat_grupos.grupo as grupo, inscripciones.id_materia as id_materia, cat_materias.materia as materia, inscripciones.id_alumno as id_alumno, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt1, SUM(inscripciones.numero_inasistencias) as numero_inasistencias1
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.id_grupo = :id_grupo and inscripciones.bimestre_trimestre = 1
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b1
inner join 
(select alumnos.curp as curp2, inscripciones.id_grupo as id_grupo2, inscripciones.id_materia as id_materia2, inscripciones.id_alumno as id_alumno2, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt2, SUM(inscripciones.numero_inasistencias) as numero_inasistencias2
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 2
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b2
on b1.id_grupo = b2.id_grupo2 and b1.id_materia = b2.id_materia2 and b1.id_alumno = b2.id_alumno2
inner join 
(select alumnos.curp as curp3, inscripciones.id_grupo as id_grupo3, inscripciones.id_materia as id_materia3, inscripciones.id_alumno as id_alumno3, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt3, SUM(inscripciones.numero_inasistencias) as numero_inasistencias3
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 3
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b3
on b1.id_grupo = b3.id_grupo3 and b1.id_materia = b3.id_materia3 and b1.id_alumno = b3.id_alumno3
inner join 
(select alumnos.curp as curp4, inscripciones.id_grupo as id_grupo4, inscripciones.id_materia as id_materia4, inscripciones.id_alumno as id_alumno4, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt4, SUM(inscripciones.numero_inasistencias) as numero_inasistencias4
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 4
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b4
on b1.id_grupo = b4.id_grupo4 and b1.id_materia = b4.id_materia4 and b1.id_alumno = b4.id_alumno4
inner join 
(select alumnos.curp as curp5, inscripciones.id_grupo as id_grupo5, inscripciones.id_materia as id_materia5, inscripciones.id_alumno as id_alumno5, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt5, SUM(inscripciones.numero_inasistencias) as numero_inasistencias5
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 5
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b5
on b1.id_grupo = b5.id_grupo5 and b1.id_materia = b5.id_materia5 and b1.id_alumno = b5.id_alumno5"), 
                                        array('id_grupo' => $id));

        return view('Inscripcion.boleta_secundaria', compact('boletas', 'escolaridad', 'periodo', 'grupo'));
    }

    public function printList(Request $request){
        $alumnos = DB::table('alumnos')
            ->join('inscripciones', 'inscripciones.id_alumno', '=', 'alumnos.id_alumno')
            ->where('inscripciones.id_grupo', '=', $request -> grupo)
            ->select('alumnos.*') -> distinct()
            ->get();

        $grupoDB = Grupo::findOrFail($request -> grupo);
        $grupo = $grupoDB -> grupo;

        $escolaridad = $grupoDB -> escolaridad -> escolaridad;
        $periodo = $grupoDB -> periodo -> periodo;

        $pdf = PDF::loadView('Listas/secundaria', compact('alumnos', 'grupo', 'escolaridad', 'periodo'))->setPaper('letter', 'landscape')->setWarnings(false);
        return $pdf -> download('Lista '.$grupoDB -> grupo.'.pdf');
    }

    public function printBoleta(Request $request){
        $grupo = Grupo::findOrFail($request -> grupo);
    
        $boletas = DB::select(DB::raw("select id_alumno, nombre, a_paterno, a_materno, curp, id_grupo, grupo, id_materia, materia, promediobt1, numero_inasistencias1, promediobt2, numero_inasistencias2, promediobt3, numero_inasistencias3, promediobt4, numero_inasistencias4, promediobt5, numero_inasistencias5
from
(select alumnos.nombre as nombre, alumnos.a_paterno as a_paterno, alumnos.a_materno as a_materno, alumnos.curp as curp, inscripciones.id_grupo as id_grupo, cat_grupos.grupo as grupo, inscripciones.id_materia as id_materia, cat_materias.materia as materia, inscripciones.id_alumno as id_alumno, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt1, SUM(inscripciones.numero_inasistencias) as numero_inasistencias1
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.id_grupo = :id_grupo and inscripciones.bimestre_trimestre = 1
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b1
inner join 
(select alumnos.curp as curp2, inscripciones.id_grupo as id_grupo2, inscripciones.id_materia as id_materia2, inscripciones.id_alumno as id_alumno2, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt2, SUM(inscripciones.numero_inasistencias) as numero_inasistencias2
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 2
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b2
on b1.id_grupo = b2.id_grupo2 and b1.id_materia = b2.id_materia2 and b1.id_alumno = b2.id_alumno2
inner join 
(select alumnos.curp as curp3, inscripciones.id_grupo as id_grupo3, inscripciones.id_materia as id_materia3, inscripciones.id_alumno as id_alumno3, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt3, SUM(inscripciones.numero_inasistencias) as numero_inasistencias3
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 3
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b3
on b1.id_grupo = b3.id_grupo3 and b1.id_materia = b3.id_materia3 and b1.id_alumno = b3.id_alumno3
inner join 
(select alumnos.curp as curp4, inscripciones.id_grupo as id_grupo4, inscripciones.id_materia as id_materia4, inscripciones.id_alumno as id_alumno4, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt4, SUM(inscripciones.numero_inasistencias) as numero_inasistencias4
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 4
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b4
on b1.id_grupo = b4.id_grupo4 and b1.id_materia = b4.id_materia4 and b1.id_alumno = b4.id_alumno4
inner join 
(select alumnos.curp as curp5, inscripciones.id_grupo as id_grupo5, inscripciones.id_materia as id_materia5, inscripciones.id_alumno as id_alumno5, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt5, SUM(inscripciones.numero_inasistencias) as numero_inasistencias5
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 5
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b5
on b1.id_grupo = b5.id_grupo5 and b1.id_materia = b5.id_materia5 and b1.id_alumno = b5.id_alumno5"), 
                                        array('id_grupo' => $request -> grupo)
                                );

        $escolaridad = $grupo -> escolaridad -> escolaridad;
        $periodo = $grupo -> periodo -> periodo;

        $pdf = PDF::loadView('Boletas/boleta_secundaria', compact('boletas', 'escolaridad', 'periodo', 'grupo'))->setPaper('letter', 'portrait')->setWarnings(false);
        return $pdf -> download('Boleta '.$grupo -> grupo.'.pdf');
    }
}
