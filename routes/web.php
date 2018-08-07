<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $pagina = App\Pagina::where('activo', '=', 1) -> first();
    $banner_principal_texto = explode('&', $pagina -> banner_principal_texto);
    $pagina_convenios = App\Pagina_convenios::where('id_pagina', $pagina -> id)->get();
    $pagina_horarios = App\Pagina_horarios::where('id_pagina', $pagina -> id)->get();
    $pagina_instalaciones = App\Pagina_instalaciones::where('id_pagina', $pagina -> id)->get();
    $pagina_oferta = App\Pagina_oferta::where('id_pagina', $pagina -> id)->get();
    $pagina_talleres = App\Pagina_talleres::where('id_pagina', $pagina -> id)->get();
    $settings = App\Setting::all();
    $visita = new App\Visita;
    $visita -> save();
    $escolaridades = App\Escolaridad::all();
    return view('inicio', compact('pagina','banner_principal_texto','pagina_convenios','pagina_horarios','pagina_instalaciones','pagina_oferta','pagina_talleres','escolaridades'));
})->name('inicio');

/*Route::get('inicio', function () {
    return view('inicio');
});*/

Route::get('/oferta', function () {
    return view('oferta');
});

Route::get('/talleres', function () {
    return view('talleres');
});

Route::get('municipios', function(){
	return \App\Municipio::with('estado')->get();
});

Route::resource('Agenda', 'AgendaController');
Route::get('Calendario', 'AgendaController@calendario')->name('Calendario');

Route::resource('Alumno', 'AlumnoController');
Route::get('AlumnoRegister/{id_alumno}', ['as' => 'AlumnoRegister', 'uses' =>'AlumnoController@register']);
Route::post('AlumnoRegistered', ['as' => 'AlumnoRegistered', 'uses' =>'AlumnoController@registerAlumno']);
Route::get('AlumnoCalifs', ['as' => 'AlumnoCalifs', 'uses' =>'AlumnoController@checkScores']);

Route::resource('AntecedenteLaboral', 'AntecedenteLaboralController');

Route::resource('Calificacion', 'CalificacionController');

Route::resource('Escolaridad', 'EscolaridadController');

Route::resource('Estado', 'EstadoController');

Route::resource('EstadoCivil', 'EstadoCivilController');

Route::resource('Grupo', 'GrupoController');
Route::get('GrupoAsocia/{id_grupo}', ['as' => 'GrupoAsocia', 'uses' => 'GrupoController@asociarMaterias']);
Route::get('GrupoEstad/{id_grupo}', ['as' => 'GrupoEstad', 'uses' => 'GrupoController@estadistica']);
Route::post('GrupoGuardar', ['as' => 'GrupoGuardar', 'uses' => 'GrupoController@guardarMaterias']);

Route::resource('Informe', 'InformeController');
Route::post('InformeAttention', ['as' => 'InformeAttention', 'uses' => 'InformeController@attend']);

Route::resource('Inscripcion', 'InscripcionController');
Route::get('InscripcionList/{id_grupo}', ['as' => 'InscripcionList', 'uses' => 'InscripcionController@listarGrupo']);
Route::get('InscripcionBoleta/{id_grupo}', ['as' => 'InscripcionBoleta', 'uses' => 'InscripcionController@boletaGrupo']);
Route::post('PrintList', ['as' => 'PrintList', 'uses' => 'InscripcionController@printList']);
Route::post('PrintBoleta', ['as' => 'PrintBoleta', 'uses' => 'InscripcionController@printBoleta']);

Route::resource('Materia', 'MateriaController');

Route::resource('Municipio', 'MunicipioController');

Route::resource('Notificacion', 'NotificacionController');
Route::post('NotificacionPublish', ['as' => 'NotificacionPublish', 'uses' => 'NotificacionController@publish']);

Route::resource('Pagina', 'PaginaController');
Route::get('editPagina/{id}', ['as' => 'editPagina', 'uses' =>'PaginaController@editarPagina']);
Route::post('updatePagina', ['as' => 'updatePagina', 'uses' => 'PaginaController@updatePagina']);
Route::get('editOferta/{id}', ['as' => 'editOferta', 'uses' =>'PaginaController@editarOferta']);
Route::post('updateOferta', ['as' => 'updateOferta', 'uses' => 'PaginaController@updateOferta']);
Route::get('editTaller/{id}', ['as' => 'editTaller', 'uses' =>'PaginaController@editarTaller']);
Route::post('updateTaller', ['as' => 'updateTaller', 'uses' => 'PaginaController@updateTaller']);
Route::get('editInstalacion/{id}', ['as' => 'editInstalacion', 'uses' =>'PaginaController@editarInstalacion']);
Route::post('updateInstalacion', ['as' => 'updateInstalacion', 'uses' => 'PaginaController@updateInstalacion']);
Route::get('editHorario/{id}', ['as' => 'editHorario', 'uses' =>'PaginaController@editarHorario']);
Route::post('updateHorario', ['as' => 'updateHorario', 'uses' => 'PaginaController@updateHorario']);
Route::get('editConvenio/{id}', ['as' => 'editConvenio', 'uses' =>'PaginaController@editarConvenio']);
Route::post('updateConvenio', ['as' => 'updateConvenio', 'uses' => 'PaginaController@updateConvenio']);
Route::post('storeInforme', ['as' => 'storeInforme', 'uses' => 'PaginaController@storeInforme']);
Route::get('PaginaUse/{id}', ['as' => 'PaginaUse', 'uses' =>'PaginaController@utilize']);
Route::get('paginaEstadistica', ['as' => 'paginaEstadistica', 'uses' => 'PaginaController@estadistica']);

Route::resource('Panel', 'PanelController');

Route::resource('Parentesco', 'ParentescoController');

Route::resource('Planeacion', 'PlaneacionController');
Route::post('PlaneacionSend', ['as' => 'PlaneacionSend', 'uses' => 'PlaneacionController@send']);
Route::get('PlaneacionAnual', 'PlaneacionController@createAnual')->name('PlaneacionAnual');
Route::get('PlaneacionEstad/{id_planeacion}', ['as' => 'PlaneacionEstad', 'uses' => 'PlaneacionController@estadistica']);
Route::get('editPlaneacion/{id}', ['as' => 'editPlaneacion', 'uses' =>'PlaneacionController@editPlaneacion']);
Route::post('updatePlaneacion', ['as' => 'updatePlaneacion', 'uses' => 'PlaneacionController@updatePlaneacion']);
Route::get('editAnexo/{id}', ['as' => 'editAnexo', 'uses' =>'PlaneacionController@editAnexo']);
Route::post('updateAnexo', ['as' => 'updateAnexo', 'uses' => 'PlaneacionController@updateAnexo']);
Route::get('editPropuesta/{id}', ['as' => 'editPropuesta', 'uses' =>'PlaneacionController@editPropuesta']);
Route::post('updatePropuesta', ['as' => 'updatePropuesta', 'uses' => 'PlaneacionController@updatePropuesta']);
Route::get('createPropuesta/{id}', ['as' => 'createPropuesta', 'uses' =>'PlaneacionController@createPropuesta']);
Route::post('storePropuesta', ['as' => 'storePropuesta', 'uses' => 'PlaneacionController@storePropuesta']);

Route::resource('Periodo', 'PeriodoController');

Route::resource('PrepAcademica', 'PrepAcademicaController');

Route::resource('Religion', 'ReligionController');

Route::resource('Rol', 'RolController');

Route::resource('Setting', 'SettingController');

Route::resource('Trabajador', 'TrabajadorController');

Route::get('/ajax-getMunicipio', function(){
	$estado = Request::get('id_estado');
	$municipios = App\Municipio::where('id_estado', '=', $estado) -> get();
	return Response::json($municipios);
});

Route::get('/ajax-getGrupo', function(){
	$periodo = Request::get('id_periodo');
	$escolaridad = Request::get('id_escolaridad');
	$grupos = App\Grupo::where('id_periodo', '=', $periodo) 
			  -> where('id_escolaridad', '=', $escolaridad) -> get();
	return Response::json($grupos);
});

Route::get('/ajax-getMaxTrabajador', function(){
	$trabajador = App\Trabajador::max('id_trabajador');
	return Response::json($trabajador);
});

Route::get('/ajax-getCalificacion', function(){
	$id_periodo = Request::get('id_periodo');
	$id_alumno = Request::get('id_alumno');
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
where inscripciones.id_alumno = :id_alumno and cat_grupos.id_periodo = :id_periodo and inscripciones.bimestre_trimestre = 1
group by inscripciones.id_alumno, inscripciones.id_grupo, cat_materias.materia, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b1
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
on b1.id_grupo = b5.id_grupo5 and b1.id_materia = b5.id_materia5 and b1.id_alumno = b5.id_alumno5"), 
                                        array('id_alumno' => $id_alumno, 'id_periodo' => $id_periodo));
	return Response::json($boletas);
});

Route::get('/ajax-getGruposDeTrabajador', function(){
	$periodo = Request::get('id_periodo');
	$trabajador = Request::get('id_trabajador');
	$rol = Request::get('id_rol');
	$escolaridad = explode('-', Request::get('escolaridad'));
	if($rol === 'dir_general'){
		$grupos = DB::table('cat_grupos')
	              ->join('materia_x_grupos', 'cat_grupos.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('cat_materias', 'cat_materias.id_materia', '=', 'materia_x_grupos.id_materia')
	              ->where('cat_grupos.id_periodo', $periodo)
	              ->select('cat_grupos.id_grupo as id_grupo', 'cat_grupos.grupo as grupo', 'cat_materias.id_materia as id_materia', 'cat_materias.materia as materia') -> distinct() -> get();
	}else if($rol === 'director' && $escolaridad[1] !== null){
		$grupos = DB::table('cat_grupos')
	              ->join('materia_x_grupos', 'cat_grupos.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('cat_materias', 'cat_materias.id_materia', '=', 'materia_x_grupos.id_materia')
	              ->where('cat_grupos.id_periodo', $periodo)
	              ->where('cat_grupos.id_escolaridad', $escolaridad[0])
	              ->select('cat_grupos.id_grupo as id_grupo', 'cat_grupos.grupo as grupo', 'cat_materias.id_materia as id_materia', 'cat_materias.materia as materia') -> distinct() -> get();
	}else if($rol === 'profesor'){
		$grupos = DB::table('cat_grupos')
	              ->join('materia_x_grupos', 'cat_grupos.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('cat_materias', 'cat_materias.id_materia', '=', 'materia_x_grupos.id_materia')
	              ->where('materia_x_grupos.id_trabajador', $trabajador)
	              ->where('cat_grupos.id_periodo', $periodo)
	              ->select('cat_grupos.id_grupo as id_grupo', 'cat_grupos.grupo as grupo', 'cat_materias.id_materia as id_materia', 'cat_materias.materia as materia') -> distinct() -> get();
	}
	return Response::json($grupos);
});

Route::get('/ajax-getAlumnosDeTrabajador', function(){
	$periodo = Request::get('id_periodo');
	$trabajador = Request::get('id_trabajador');
	$rol = Request::get('id_rol');
	$escolaridad = explode('-', Request::get('escolaridad'));
	if($rol === 'dir_general'){
		$alumnos = DB::table('cat_grupos')
	              ->join('materia_x_grupos', 'cat_grupos.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('inscripciones', 'inscripciones.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('alumnos', 'inscripciones.id_alumno', '=', 'alumnos.id_alumno')
	              ->where('cat_grupos.id_periodo', $periodo)
	              ->select('alumnos.id_alumno as id_alumno', 'alumnos.nombre as nombre', 'alumnos.a_paterno as a_paterno', 'alumnos.a_materno as a_materno') -> distinct() -> get();
	}else if($rol === 'director' && $escolaridad[1] !== null && $escolaridad[0] !== 0){
		$alumnos = DB::table('cat_grupos')
	              ->join('materia_x_grupos', 'cat_grupos.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('inscripciones', 'inscripciones.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('alumnos', 'inscripciones.id_alumno', '=', 'alumnos.id_alumno')
	              ->where('cat_grupos.id_escolaridad', $escolaridad[0])
	              ->where('cat_grupos.id_periodo', $periodo)
	              ->select('alumnos.id_alumno as id_alumno', 'alumnos.nombre as nombre', 'alumnos.a_paterno as a_paterno', 'alumnos.a_materno as a_materno') -> distinct() -> get();
	}else if($rol === 'profesor'){
		$alumnos = DB::table('cat_grupos')
	              ->join('materia_x_grupos', 'cat_grupos.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('inscripciones', 'inscripciones.id_grupo', '=', 'materia_x_grupos.id_grupo')
	              ->join('alumnos', 'inscripciones.id_alumno', '=', 'alumnos.id_alumno')
	              ->where('materia_x_grupos.id_trabajador', $trabajador)
	              ->where('cat_grupos.id_periodo', $periodo)
	              ->select('alumnos.id_alumno as id_alumno', 'alumnos.nombre as nombre', 'alumnos.a_paterno as a_paterno', 'alumnos.a_materno as a_materno') -> distinct() -> get();
	}

	return Response::json($alumnos);
});

Route::get('/ajax-getTrabajadores', function(){
	$trabajador;
	$periodo = Request::get('id_periodo');
	$trabajador_actual = Request::get('id_trabajador');
	$rol = Request::get('id_rol');
	$escolaridad = explode('-', Request::get('escolaridad'));
	if($rol === 'director' && $escolaridad[1] !== null){
		$trabajador = App\Trabajador::where('id_escolaridad', $escolaridad[0])
					->where('id_trabajador', '!=', $trabajador_actual) 
					->get();
	}
	if($rol === 'dir_general' && $escolaridad[1] !== null){
		$trabajador = App\Trabajador::where('id_escolaridad', $escolaridad[0])
					->where('id_trabajador', '!=', $trabajador_actual) 
					->get();
	}
	return Response::json($trabajador);
});

Route::get('/ajax-getRoles', function(){
	$rol = App\Rol::all();
	return Response::json($rol);
});

Route::resource('datatables', 'MyController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('downloadFile/{id_planeacion}', ['as' => 'downloadFile', 'uses' => 'PlaneacionController@downloadFile']);


