<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AlumnoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Alumno;
use App\Carrera;
use App\Trabajador;
use App\Periodo;
use App\Grupo;
use App\Escolaridad;
use App\Inscripcion;

use App\Setting;
use App\User;
use DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*function __construct(){
        $this -> middleware('auth', ['except' => ['checkScores']]);
        $this -> middleware('roles:dir_general,director,profesor', ['except' => ['checkScores']]);
    }*/

    public function index()
    {
        //
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        $alumnos = Alumno::where('nombre', 'like', '%'.$criterio.'%')
        ->orwhere('id_alumno',$criterio)
        ->orwhere('a_paterno','like','%'.$criterio.'%')
        ->orwhere('a_materno','like','%'.$criterio.'%')
        ->orwhere('curp','like','%'.$criterio.'%')
        ->sortable()
        ->orderBy('id_alumno')
        ->orderBy('nombre')
        ->paginate(10);
        
        return view('Alumno.index', compact('alumnos'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $carreras = Carrera::orderBy('nombre_reducido') -> get();

        return view('Alumno.create', compact('carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoRequest $request)
    {
        //
        $alumno = new Alumno;
        $alumno -> nombre = $request -> nombre;
        $alumno -> a_paterno = $request -> a_paterno;
        $alumno -> a_materno = $request -> a_materno;
        $alumno -> curp = strtoupper($request -> curp);
        $alumno -> telefono = $request -> telefono;
        $alumno -> email = $request -> email;
        $alumno -> sexo = $request -> sexo;
        $alumno -> fecha_nacimiento = $request -> fecha_nacimiento;
        $alumno -> id_carrera = $request -> id_carrera;
        $alumno -> padecimientos = $request -> padecimiento;
        if($request -> no_control !== null)
            $alumno -> no_control = $request -> no_control;
        $alumno -> padre_o_tutor = $request -> padre_o_tutor;
        if($request -> extras == 1)
            $alumno -> trabajador = true;
        if($request -> extras == 2)
            $alumno -> hijo_trabajador = true;
        
        if($request -> hasFile('foto')){
            $alumno -> foto = $request -> file('foto') -> storeAs('public/alumnos', strtoupper($request -> curp).'.'.$request -> file('foto') -> extension());
        }       
        $guardado = $alumno -> save();

        $this -> addUser($request);

        if($guardado)
            return redirect()->route('Alumno.index')->with('info','Alumno creado con éxito.');
        else
            return redirect()->route('Alumno.index')->with('error','Imposible guardar Alumno.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id); 
        $carreras = Carrera::orderBy('nombre_reducido') -> get();

        return view('Alumno.show', compact('alumno', 'carreras'));
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
        $alumno = Alumno::findOrFail($id);
        $carreras = Carrera::orderBy('nombre_reducido') -> get();

        return view('Alumno.edit', compact('alumno', 'carreras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnoRequest $request, $id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno -> nombre = $request -> nombre;
        $alumno -> a_paterno = $request -> a_paterno;
        $alumno -> a_materno = $request -> a_materno;
        $alumno -> curp = $request -> curp;
        $alumno -> id_estado_municipio = $request -> id_estado_municipio;
        $alumno -> extranjero = $request -> extranjero;
        $alumno -> calle = $request -> calle;
        $alumno -> numero_interior = $request -> numero_interior;
        $alumno -> numero_exterior = $request -> numero_exterior;
        $alumno -> colonia = $request -> colonia;
        $alumno -> cp = $request -> cp;
        $alumno -> telefono = $request -> telefono;
        $alumno -> email = $request -> email;
        $alumno -> id_religion = $request -> id_religion;
        $alumno -> tipo_sangre = $request -> tipo_sangre;
        if($request -> hasFile('foto')){
            Storage::delete($alumno -> foto);
            $alumno -> foto = $request -> file('foto') -> storeAs('public/alumnos', $request -> curp.'.jpeg');
        }
        $guardado = $alumno -> save();

        $this -> UpdateUser($request, $id);

        if($guardado)
            return redirect()->route('Alumno.index')->with('info','Alumno actualizado con éxito.');
        else
            return redirect()->route('Alumno.index')->with('error','Imposible guardar Alumno.');
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
        $destruido = null;

        $alumno = Alumno::findOrFail($id);
        Storage::delete($alumno -> foto);

        $destruido = Alumno::destroy($id);
        if($destruido)
            return redirect()->route('Alumno.index')->with('info','Alumno eliminado con éxito.');
        else
            return redirect()->route('Alumno.index')->with('error','Imposible borrar Alumno.');
    }

    public function register($id)
    {
        $ya_inscrito = false;
        $periodo_actual = Setting::all()->pluck('id_periodo');
        $periodo = Periodo::findOrFail($periodo_actual);
        $escolaridades = Escolaridad::orderBy('escolaridad') -> paginate(50);
        $grupos = Grupo::where('id_periodo', '=', $periodo_actual) -> get();
        $alumno = Alumno::findOrFail($id);

        $periodo_inscrito = DB::table('inscripciones')
            ->join('cat_grupos', 'inscripciones.id_grupo', '=', 'cat_grupos.id_grupo')
            ->where('inscripciones.id_alumno', '=', $id)
            ->select('cat_grupos.id_periodo', 'cat_grupos.id_grupo', 'cat_grupos.grupo') 
            ->distinct()
            ->get();

        $ultimo_periodo = count($periodo_inscrito);
       
        if($ultimo_periodo != 0){
            for($i = 0; $i < $ultimo_periodo; $i++){
                if($periodo_inscrito[$i] -> id_periodo == $periodo_actual[0]){
                    $ya_inscrito = true;
                    break;
                }else{
                    $ya_inscrito = false;
                }
            }
        }else{
           $ya_inscrito = false; 
        }

        return view('Alumno.register', compact('alumno', 'periodo', 'periodo_inscrito', 'escolaridades', 'grupos', 'ya_inscrito'));         
    }

    public function registerAlumno(Request $request)
    {
                
        $inscripciones = array();
        if($request -> ya_inscrito == true){
            $periodo_actual = Setting::all()->pluck('id_periodo');
            $inscripciones = DB::table('inscripciones')
            ->join('cat_grupos', 'inscripciones.id_grupo', '=', 'cat_grupos.id_grupo')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'inscripciones.id_alumno')
            ->where('inscripciones.id_alumno', '=', $request->id_alumno)
            ->where('cat_grupos.id_periodo', '=', $periodo_actual[0])
            ->select('inscripciones.id_inscripcion')
            ->get();
            
            for($i = 0; $i < count($inscripciones); $i++){
                Inscripcion::destroy($inscripciones[$i] -> id_inscripcion);    
            }
            return redirect()->route('Alumno.index')->with('info','Alumno dado de baja con éxito.');
        }else{
            $this->validate($request, [
                'id_escolaridad' => 'required|not_in:0',
                'id_grupo' => 'required|not_in:0',
            ]);
            
            $bimestre_o_trimestre = 0;
            $grupo = Grupo::findOrFail($request -> id_grupo);
            $materias = $grupo -> materias() -> get();
            
            if(substr( $grupo -> escolaridad -> escolaridad , 0, 4 ) === "Pres")
                $bimestre_o_trimestre = 4;
            else
                $bimestre_o_trimestre = 6;

            if(count($materias)==0)
                return redirect()->route('Alumno.index')->with('error','Imposible inscribir Alumno ya que el grupo que eligió no tiene materias asociadas.');
            $i = 0;
            foreach ($materias as $materia) {
                for($j = 1; $j < $bimestre_o_trimestre ; $j++){
                    $inscripcion = new Inscripcion;
                    $inscripcion -> id_grupo = $request -> id_grupo;
                    $inscripcion -> id_materia = $materia -> id_materia;
                    $inscripcion -> id_alumno = $request -> id_alumno;
                    $inscripcion -> bimestre_trimestre = $j;
                    $inscripcion -> save();
                }
                $i ++;
            }
            
            if(count($materias) == $i)
                return redirect()->route('Alumno.index')->with('info','Alumno inscrito con éxito.');
            else
                return redirect()->route('Alumno.index')->with('error','Imposible inscribir Alumno.');
        }   
    }

    public function addUser(Request $request){
        $user = new User;
        $alumno = Alumno::find(DB::table('alumnos')->max('id_alumno'));
        $user -> id_alumno = $alumno -> id_alumno;
        $user -> name = $request -> nombre.' '.$request -> a_paterno.' '.$request -> a_materno;
        $user -> email = $request -> email;
        $user -> password = bcrypt('123123');
        $user -> photo = $alumno -> foto;
        $user -> save();
        $user -> roles() -> attach('3');
        //$user -> roles() -> attach($request -> id_rol);
    }

    public function updateUser(Request $request, $id){
        $user = User::where('id_alumno', $id) -> first();
        $alumno = Alumno::findOrFail($id);
        $user -> name = $request -> nombre.' '.$request -> a_paterno.' '.$request -> a_materno;
        $user -> email = $request -> email;
        $user -> photo = $alumno -> foto;
        $user -> save();
        //$user -> roles() -> attach($request -> id_rol);
    }

    public function checkScores(){
        $grupo = null;
        $escolaridad = null;
        $periodo = null;
        $boletas = DB::select(DB::raw("select id_alumno, nombre, a_paterno, a_materno, curp, id_grupo, grupo, id_periodo, periodo, id_materia, materia, promediobt1, numero_inasistencias1, promediobt2, numero_inasistencias2, promediobt3, numero_inasistencias3, promediobt4, numero_inasistencias4, promediobt5, numero_inasistencias5
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
where inscripciones.id_alumno = :id_alumno and inscripciones.bimestre_trimestre = 1
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b1
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
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b5
on b1.id_grupo = b5.id_grupo5 and b1.id_materia = b5.id_materia5 and b1.id_alumno = b5.id_alumno5"), 
                                        array('id_alumno' => Auth::user()-> id_alumno));
        $alumno = Auth::user()-> id_alumno;
        if( !empty($boletas) ){
            $grupo = Grupo::findOrFail($boletas[0]->id_grupo);
            $escolaridad = $grupo -> escolaridad -> escolaridad;
            $periodo = $grupo -> periodo -> periodo;
        }
        return view('Alumno.calificaciones', compact('boletas', 'grupo', 'escolaridad', 'periodo', 'alumno'));
    }
}
