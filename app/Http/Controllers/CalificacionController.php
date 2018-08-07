<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripcion;
use App\Grupo;
use App\Alumno;
use DB;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct(){
        $this -> middleware(['auth', 'roles:dir_general,director,profesor,padre_familia,alumno']);
    }*/
    
    public function index()
    {
        //
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
        $total = count($request -> inscripcion);
        for ($i = 0; $i < $total; $i++){
            $inscripcion = Inscripcion::findOrFail($request -> inscripcion[$i]);
            $inscripcion -> examen = $request -> examen[$i];
            $inscripcion -> tareas = $request -> tareas[$i];
            $inscripcion -> trabajos = $request -> trabajos[$i];
            $inscripcion -> asistencias = $request -> asistencias[$i];
            $inscripcion -> puntos_extra = $request -> puntos_extra[$i];
            $inscripcion -> examen_extra = $request -> examen_extra[$i];
            $inscripcion -> numero_inasistencias = $request -> numero_inasistencias[$i];
            $inscripcion -> save();
        }

        return redirect()->route('Inscripcion.index')->with('info','Calificaciones guardadas con éxito.');
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
        $inscripciones = null;
        $usuario = null;
        $grupo = Grupo::findOrFail($id);
        $materias = array();

        $settings = DB::table('cat_grupos')
                    ->join('cat_periodos', function ($join) use($id) {
                        $join->on('cat_grupos.id_periodo', '=', 'cat_periodos.id_periodo')
                             ->where('cat_grupos.id_grupo', '=', $id);
                    })
                    ->select('cat_periodos.trimestre_preescolar','cat_periodos.bimestre_primaria','cat_periodos.bimestre_secundaria')
                    ->get();

        $trimestre = $settings[0] -> trimestre_preescolar;
        $bimestre_primaria = $settings[0] -> bimestre_primaria;
        $bimestre_secundaria = $settings[0] -> bimestre_secundaria;

        if(auth() -> user() -> hasRoles(['dir_general', 'director'])){
                       
            $usuario = DB::select(DB::raw("select cat_roles.rol_key, materia_x_grupos.id_materia
                        from users
                        inner join roles_x_users
                        on users.id_user = roles_x_users.id_user
                        inner join cat_roles
                        on roles_x_users.id_rol = cat_roles.id_rol
                        inner join materia_x_grupos
                        on materia_x_grupos.id_trabajador = users.id_user
                        where materia_x_grupos.id_grupo = :id_grupo"), 
                                    array('id_grupo' => $id)
                                );

            if(count($usuario) > 0){
               
                for($i = 0; $i < count($usuario) ; $i++ ){
                    array_push($materias, $usuario[$i] -> id_materia);
                }

                $inscripciones = Inscripcion::where('id_grupo', '=', $grupo -> id_grupo) 
                            -> where('bimestre_trimestre', '=', $bimestre_secundaria)
                            -> orderBy('id_alumno')
                            -> get();

            }else{
                return view('errors.500');
            }


        }else{

            $usuario = DB::select(DB::raw("select cat_roles.rol_key, materia_x_grupos.id_materia
                        from users
                        inner join roles_x_users
                        on users.id_user = roles_x_users.id_user
                        inner join cat_roles
                        on roles_x_users.id_rol = cat_roles.id_rol
                        inner join materia_x_grupos
                        on materia_x_grupos.id_trabajador = users.id_user
                        where users.id_user = :id_user and materia_x_grupos.id_grupo = :id_grupo"), 
                                    array('id_user' => auth() -> user() -> id_user, 'id_grupo' => $id)
                                );

            if(count($usuario) > 0){
                
                for($i = 0; $i < count($usuario) ; $i++ ){
                    array_push($materias, $usuario[$i] -> id_materia);
                }

                $inscripciones = Inscripcion::where('id_grupo', '=', $grupo -> id_grupo) 
                                -> whereIn('id_materia', $materias)
                                -> where('bimestre_trimestre', '=', $bimestre_secundaria)
                                -> orderBy('id_alumno')
                                -> get();
            }else{
                return view('errors.500');
            }
        }

        $numero_de_materias = count($usuario);
        //dd($numero_de_materias);

        return view('Calificacion.show', compact('grupo', 'inscripciones', 'bimestre_secundaria', 'numero_de_materias'));
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
