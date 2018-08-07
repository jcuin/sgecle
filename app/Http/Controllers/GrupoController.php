<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GrupoRequest;
use App\Grupo;
use App\Periodo;
use App\Escolaridad;
use App\Materia;
use App\materia_x_grupo;
use App\Inscripcion;
use App\Trabajador;
use App\Setting;
use App\Agenda;
use DB;

class GrupoController extends Controller
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
        $periodos = Periodo::orderBy('id_periodo')->paginate(10);
        $escolaridades = Escolaridad::orderBy('id_escolaridad')->paginate(10);
        $setting = Setting::find(1);
        
        $grupos = Grupo::where('id_periodo', $setting -> id_periodo)
        ->where('grupo', 'like', '%'.$criterio.'%')
        ->orwhere('id_grupo', $criterio)
        ->orwhere('id_periodo', $criterio)
        ->orwhere('id_escolaridad', $criterio)
        ->sortable()
        ->orderBy('id_periodo')
        ->orderBy('id_escolaridad')
        ->orderBy('id_grupo')
        ->paginate(10);
         
        return view('Grupo.index',compact('grupos', 'escolaridades', 'periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $periodo_actual = Setting::all()->pluck('id_periodo');
        $periodo = Periodo::findOrFail($periodo_actual[0]);
        $escolaridades = Escolaridad::orderBy('id_escolaridad')->paginate(50);
        return view('Grupo.create', compact('periodo', 'escolaridades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrupoRequest $request)
    {
        //
        $periodo_actual = Setting::all()->pluck('id_periodo');
        $grupo = new Grupo;
        $grupo -> id_periodo = $periodo_actual[0];
        $grupo -> id_escolaridad = $request -> id_escolaridad;
        $grupo -> grupo = $request -> grupo;
        $grupo -> capacidad = $request -> capacidad;
        $guardado = $grupo -> save();

        if($guardado)
            return redirect()->route('Grupo.index')->with('info','Grupo creado con éxito.');
        else
            return redirect()->route('Grupo.index')->with('error','Imposible guardar Grupo.');
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
        return view('Grupo.show', compact('grupo'));
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
        $periodo_actual = Setting::all()->pluck('id_periodo');
        $periodo = Periodo::findOrFail($periodo_actual[0]);
        $escolaridades = Escolaridad::orderBy('id_escolaridad')->paginate(10);
        $grupo = Grupo::findOrFail($id);
        return view('Grupo.edit', compact('grupo', 'periodo', 'escolaridades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GrupoRequest $request, $id)
    {
        //
        $periodo_actual = Setting::all()->pluck('id_periodo');
        $grupo = Grupo::findOrFail($id);
        $grupo -> id_periodo = $periodo_actual[0];
        $grupo -> id_escolaridad = $request -> id_escolaridad;
        $grupo -> grupo = $request -> grupo;
        $grupo -> capacidad = $request -> capacidad;
        $guardado = $grupo -> save();
        
        if($guardado)
            return redirect()->route('Grupo.index')->with('info','Grupo actualizado con éxito.');
        else
            return redirect()->route('Grupo.index')->with('error','Imposible actualizar Grupo.');
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
        $destruido = Grupo::destroy($id);
        
        if($destruido)
            return redirect()->route('Grupo.index')->with('info','Grupo eliminado con éxito.');
        else
            return redirect()->route('Grupo.index')->with('error','Imposible borrar Grupo.');
    }

    public function asociarMaterias($id)
    {
        $grupo = Grupo::findOrFail($id);
        $profesores_asignados = DB::select(DB::raw("select materia_x_grupos.id_materia,
                                        materia_x_grupos.id_trabajador
                                        from materia_x_grupos
                                        inner join cat_materias
                                        on materia_x_grupos.id_materia = cat_materias.id_materia
                                        where materia_x_grupos.id_grupo = :id_grupo
                                        order by cat_materias.materia"), 
                                        array('id_grupo' => $id));

        $materias = Materia::orderBy('materia')->paginate(10);
        
        $trabajadores =  DB::select(DB::raw("select trabajadors.id_trabajador, trabajadors.nombre, trabajadors.a_paterno, trabajadors.a_materno
                from trabajadors
                inner join users
                on trabajadors.id_trabajador = users.id_trabajador
                inner join roles_x_users
                on users.id_user = roles_x_users.id_user
                inner join cat_roles
                on cat_roles.id_rol = roles_x_users.id_rol
                and cat_roles.rol_key = :rol"), 
                array('rol' => 'profesor'));
      
        return view('Grupo.asociar', compact('grupo', 'materias', 'trabajadores', 'profesores_asignados'));
    }

    public function guardarMaterias(Request $request)
    {
        //dd($request -> trabajadores);
        $grupo = Grupo::findOrFail($request -> id_grupo);
        $grupo -> materias() -> sync($request -> materias);
      
        $materias = $grupo -> materias() -> orderBy('materia') -> get();

        $materias_existentes = Materia::orderBy('materia') -> get();
        $materias_existentes = $materias_existentes -> pluck('id_materia');
        $trabajadores_existentes = $request -> trabajadores;

        for($i = 0; $i < count($materias_existentes); $i ++){
            foreach ($materias as $materia) {
                if($materias_existentes[$i] == $materia -> id_materia){
                    if($trabajadores_existentes[$i] != 0){
                        $materia -> pivot -> id_trabajador = $trabajadores_existentes[$i];
                    }else{
                        $materia -> pivot -> id_trabajador = null;
                    }
                    $materia -> pivot -> save();
                }
            }
        }
    
        $this -> actualizarAlumnos($request -> id_grupo);

        return redirect()->route('Grupo.index')->with('materias_asociadas','Materias asociadas con éxito.');
    }

    public function actualizarAlumnos($id)
    {
        $alumnos = Inscripcion::where('id_grupo', '=', $id)
            ->select('id_alumno')
            ->distinct()
            ->get();       

        $materias = DB::select(DB::raw("select materia_x_grupos.id_materia
                                        from materia_x_grupos
                                        left join inscripciones
                                        on materia_x_grupos.id_grupo = inscripciones.id_grupo 
                                        and materia_x_grupos.id_materia = inscripciones.id_materia
                                        where materia_x_grupos.id_grupo = :id_grupo and inscripciones.id_alumno is null"), 
                                        array('id_grupo' => $id)
                                );

        $bimestre_o_trimestre = 0;
        $grupo = Grupo::findOrFail($id);
        if(substr( $grupo -> escolaridad -> escolaridad , 0, 4 ) === "Pres")
            $bimestre_o_trimestre = 4;
        else
            $bimestre_o_trimestre = 6;

        if(!empty($materias)){
            for($i = 0; $i < count($materias[0]); $i ++){
                for($j = 0; $j < count($alumnos); $j++){
                    for($k = 1; $k < $bimestre_o_trimestre; $k++){
                        $inscripcion = new Inscripcion;
                        $inscripcion -> id_grupo = $id;
                        $inscripcion -> id_materia = $materias[$i] -> id_materia;
                        $inscripcion -> id_alumno = $alumnos[$j] -> id_alumno;
                        $inscripcion -> bimestre_trimestre = $k;
                        $inscripcion -> save();
                    }
                }    
            }
        }
    }

    public function estadistica($id)
    {
        //

        $inscritos = explode('-',$id);

        $grupo = Grupo::findOrFail(intval($inscritos[0]));
        $escolaridad = $grupo -> escolaridad -> escolaridad;

        if(substr( $escolaridad, 0, 4 ) === "Pres")
            return redirect()->route('Inscripcion.index')->with('info','Funcionalidad por definir para Prescolar.');

$boletas = DB::select(DB::raw("
select id_materia, materia, count(*) as aprobados from 
(select  id_materia, materia, id_alumno, avg(promediobt1+promediobt2+promediobt3+promediobt4+promediobt5) AS promedio
from
(select alumnos.nombre as nombre, alumnos.a_paterno as a_paterno, alumnos.a_materno as a_materno, alumnos.curp as curp, inscripciones.id_grupo as id_grupo, cat_grupos.grupo as grupo, cat_periodos.id_periodo as id_periodo, cat_periodos.periodo as periodo, inscripciones.id_materia as id_materia, cat_materias.materia as materia, inscripciones.id_alumno as id_alumno, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt1, SUM(inscripciones.numero_inasistencias) as numero_inasistencias1
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where cat_grupos.id_periodo = 5 and inscripciones.bimestre_trimestre = 1 and inscripciones.id_grupo=:id_grupo
group by inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b1


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
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 2
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b2
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
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 3
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b3
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
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 4
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b4
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
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 5
group by inscripciones.id_alumno, inscripciones.id_grupo, cat_materias.materia, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b5
on b1.id_grupo = b5.id_grupo5 and b1.id_materia = b5.id_materia5 and b1.id_alumno = b5.id_alumno5
group by id_materia, id_alumno) AS SC 
WHERE promedio >= 6
GROUP BY id_materia order by materia"),  array('id_grupo' => $id));


        $generos = DB::select(DB::raw("select hombres.id_grupo, coalesce(mujeres.id_grupo,hombres.id_grupo) , count(distinct hombres.id_alumno) as hombres, count(distinct mujeres.id_alumno) as mujeres
from
(select distinct inscripciones.id_grupo, inscripciones.id_alumno, substring(alumnos.curp from 11 for 1) as sexo
from inscripciones
inner join alumnos
on inscripciones.id_alumno=alumnos.id_alumno 
where substring(alumnos.curp from 11 for 1) = 'H'
order by inscripciones.id_grupo) as hombres

left join (select distinct inscripciones.id_grupo, inscripciones.id_alumno, substring(alumnos.curp from 11 for 1) as sexo
from inscripciones
inner join alumnos
on inscripciones.id_alumno=alumnos.id_alumno 
where substring(alumnos.curp from 11 for 1) = 'M'
order by inscripciones.id_grupo) as mujeres
on hombres.id_grupo = mujeres.id_grupo
where hombres.id_grupo=:id_grupo
group by hombres.id_grupo, mujeres.id_grupo"),  array('id_grupo' => $id));
        
    $etiquetas = array_column($boletas, 'materia');

    $aprobados = array_column($boletas, 'aprobados');
    $reprobados = array();

    $etiquetas_generos = array('Hombres', 'Mujeres');

    $hombres_mujeres = array();

    array_push($hombres_mujeres, $generos[0] -> hombres);
    array_push($hombres_mujeres, $generos[0] -> mujeres);

    foreach ($boletas as $boleta) {
        array_push($reprobados, intval($inscritos[1]) - intval($boleta -> aprobados));
    }

        return view('Grupo.estadistica', compact('evento', 'chart'))
        ->with('aprobados', json_encode($aprobados, JSON_NUMERIC_CHECK))
        ->with('reprobados', json_encode($reprobados, JSON_NUMERIC_CHECK))
        ->with('etiquetas', json_encode($etiquetas))
        ->with('hombres_mujeres', json_encode($hombres_mujeres, JSON_NUMERIC_CHECK))
        ->with('etiquetas_generos', json_encode($etiquetas_generos));
    }
}
