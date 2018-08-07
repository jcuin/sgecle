<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TrabajadorRequest;
use Illuminate\Support\Facades\Storage;
use App\Trabajador;
use App\Municipio;
use App\Estado;
use App\Religion;
use App\EstadoCivil;
use App\Escolaridad;
use App\Conyuge;
use App\conyuge_x_trabajador;
use App\Padecimiento;
use App\AntecedenteLaboral;
use App\Parentesco;
use App\Familiar_trabajador;
use App\PrepAcademica;
use App\Rol;
use App\User;
use DB;

class TrabajadorController extends Controller
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

        $estadosciviles = EstadoCivil::orderBy('id_estado_civil')->paginate(50);
        $estados = Estado::orderBy('id_estado') -> paginate(50);
        $municipios = Municipio::orderBy('id_estado_municipio')->paginate(10);
        $religiones = Religion::orderBy('id_religion')->paginate(10);
        $roles = Rol::orderBy('id_rol')->paginate(10);
        
        $trabajadores = Trabajador::where('nombre', 'like', '%'.$criterio.'%')
        ->orwhere('id_trabajador',$criterio)
        ->orwhere('a_paterno','like','%'.$criterio.'%')
        ->orwhere('a_materno','like','%'.$criterio.'%')
        ->orwhere('curp','like','%'.$criterio.'%')
        ->orwhere('rfc','like','%'.$criterio.'%')
        ->sortable()
        ->orderBy('id_trabajador')
        ->orderBy('nombre')
        ->paginate(10);

        return view('Trabajador.index', array('trabajadores' => $trabajadores,'estadosciviles' => $estadosciviles,'estados' => $estados,'municipios' => $municipios,'religiones' => $religiones,'roles' => $roles));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //PENDIENTE VALIDAR TRABAJADORES YA COMPROMETIDOS
        //$trabajadores_comprometidos = Trabajador::where('id_trabajador', )
        
        $trabajadoresactivos = Trabajador::orderBy('nombre') -> paginate(50);
        $estadosciviles = EstadoCivil::orderBy('id_estado_civil') -> paginate(50);
        $estados = Estado::orderBy('id_estado') -> paginate(50);
        $municipios = Municipio::orderBy('id_estado_municipio') -> paginate(50);
        $religiones = Religion::orderBy('id_religion') -> paginate(50);
        $roles = Rol::orderBy('id_rol') -> paginate(50);
        $parentescos = Parentesco::orderBy('id_parentesco') -> paginate(50);
        $escolaridades = Escolaridad::orderBy('escolaridad') -> paginate(50);
        $prep_academicas = PrepAcademica::orderBy('grado_academico') -> paginate(50);
        
        return view('Trabajador.create', compact('trabajadoresactivos','estadosciviles', 'municipios', 'estados', 'religiones','roles', 'parentescos', 'escolaridades','prep_academicas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrabajadorRequest $request)
    {
        //dd($request);
        $trabajador = new Trabajador;
        $trabajador -> nombre = $request -> nombre;
        $trabajador -> a_paterno = $request -> a_paterno;
        $trabajador -> a_materno = $request -> a_materno;
        $trabajador -> curp = strtoupper($request -> curp);
        $trabajador -> rfc = $request -> rfc;
        $trabajador -> seguro_social = $request -> seguro_social;
        $trabajador -> id_estado_civil = $request -> id_estado_civil;
        $trabajador -> id_estado_municipio = $request -> id_estado_municipio;
        $trabajador -> extranjero = $request -> extranjero;
        $trabajador -> calle = $request -> calle;
        $trabajador -> numero_interior = $request -> numero_interior;
        $trabajador -> numero_exterior = $request -> numero_exterior;
        $trabajador -> colonia = $request -> colonia;
        $trabajador -> cp = $request -> cp;
        $trabajador -> telefono = $request -> telefono;
        $trabajador -> email = $request -> email;
        $trabajador -> id_religion = $request -> id_religion;
        $trabajador -> tipo_sangre = $request -> tipo_sangre;
        $trabajador -> id_prep_academica = $request -> id_prep_academica;
        $trabajador -> area_conocimiento = $request -> area_conocimiento;
        if( $request -> id_escolaridad != 0)
            $trabajador -> id_escolaridad = $request -> id_escolaridad;

        if($request -> hasFile('foto')){
            Storage::delete($trabajador -> foto);
            $trabajador -> foto = $request -> file('foto') -> storeAs('public/trabajadores', $request -> curp.'.jpeg');
        }
        $guardado = $trabajador -> save();

        if(($request -> has('nombre_conyuge')) && ($request -> nombre_conyuge != 'NA') && ($request -> id_conyuge != -1)){
            $conyuge = new Conyuge;
            $conyuge -> nombre = $request -> nombre_conyuge;
            $conyuge -> a_paterno = $request -> a_paterno_conyuge;
            $conyuge -> a_materno = $request -> a_materno_conyuge;
            $conyuge -> genero = $request -> genero_conyuge;
            $conyuge -> fecha_nacimiento = $request -> fecha_de_nacimiento_conyuge;
            $conyuge -> lugar_labora = $request -> lugar_labora_conyuge;
            $conyuge -> save();

            $conyuge_x_trabajador = new conyuge_x_trabajador;
            $conyuge_x_trabajador -> id_trabajador = DB::table('trabajadors')->max('id_trabajador');
            $conyuge_x_trabajador -> id_conyuge = DB::table('conyuges')->max('id_conyuge');
            $conyuge_x_trabajador -> es_trabajador = 0;
            $conyuge_x_trabajador -> save();
        }else if(($request -> has('nombre_conyuge')) && ($request -> nombre_conyuge == 'NA') && ($request -> id_conyuge != -1)){
            $conyuge_x_trabajador = new conyuge_x_trabajador;
            $conyuge_x_trabajador -> id_trabajador = DB::table('trabajadors')->max('id_trabajador');
            $conyuge_x_trabajador -> id_conyuge = $request -> id_conyuge;
            $conyuge_x_trabajador -> es_trabajador = 1;
            $conyuge_x_trabajador -> save();
        }

        $padecimiento = new Padecimiento;
        $padecimiento -> id_trabajador = DB::table('trabajadors')->max('id_trabajador');
        $padecimiento -> alergia = $request -> alergia;
        $padecimiento -> enfermedad = $request -> enfermedad;
        $padecimiento -> cirugia = $request -> cirugia;
        $padecimiento -> medicina = $request -> medicina;
        $padecimiento -> medico = $request -> medico;
        $padecimiento -> tel_medico = $request -> telefono_medico;
        $padecimiento -> ref1_nombre = $request -> nombre_referencia1;
        $padecimiento -> ref1_tel = $request -> telefono_referencia1;
        $padecimiento -> ref2_nombre = $request -> nombre_referencia2;
        $padecimiento -> ref2_tel = $request -> telefono_referencia2;
        $padecimiento -> save();

        $maxid = DB::table('trabajadors')->max('id_trabajador');

        for($i = 0; $i < count($request -> nombre_familiar); $i++) {
            $fam = new Familiar_trabajador;
            $fam -> id_trabajador = $maxid;
            $fam -> nombre = $request -> nombre_familiar[$i];
            $fam -> a_paterno = $request -> a_paterno_familiar[$i];
            $fam -> a_materno = $request -> a_materno_familiar[$i];
            $fam -> id_parentesco = $request -> id_parentesco_familiar[$i];
            $fam -> fecha_nacimiento = $request -> fecha_nacimiento_familiar[$i];
            $fam -> id_estado_civil = $request -> id_estado_civil_familiar[$i];
            $fam -> ocupacion = $request -> ocupacion_familiar[$i];
            if(!isset($request -> vive_familiar[$i]))
                $fam -> vive = 0;
            else
                $fam -> vive = $request -> vive_familiar[$i];
            if($request -> nombre_familiar[$i] != '')
                $fam -> save();
        }

        $antecedente = new AntecedenteLaboral;
        $antecedente -> id_trabajador = $maxid;
        if(!isset($request -> sin_experiencia)){
            $antecedente -> sin_experiencia = 0; 
            $antecedente -> trabajo_anterior = $request -> trabajo_anterior;
            $antecedente -> puesto = $request -> puesto;
            $antecedente -> inicio = $request -> fecha_inicio;
            $antecedente -> termino = $request -> fecha_termino;
        }else{
            $antecedente -> sin_experiencia = $request -> sin_experiencia;
        }
        $antecedente -> save();

        $this -> addUser($request);
        
        if($guardado)
            return redirect()->route('Trabajador.index')->with('info','Trabajador creado con éxito.');
        else
            return redirect()->route('Trabajador.index')->with('error','Imposible guardar Trabajador.');
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
        $conyuge = null;
        $trabajador = Trabajador::findOrFail($id);
        $padecimiento = Padecimiento::where('id_trabajador', '=', $id)->first();
        $antecedente = AntecedenteLaboral::where('id_trabajador', '=', $id)->first();
        $familiares = Familiar_trabajador::where('id_trabajador', '=' ,$id)->get();

        $conyuge_x_trabajador = conyuge_x_trabajador::where('id_trabajador', '=' ,$id)->first();   
        if($conyuge_x_trabajador == null){
            $conyuge_x_trabajador = conyuge_x_trabajador::where('id_conyuge', '=' ,$id)->first(); 
            if(($conyuge_x_trabajador != null) && ($conyuge_x_trabajador -> es_trabajador == 1)){
                $conyuge = Trabajador::where('id_trabajador', '=' , $conyuge_x_trabajador -> id_trabajador)->first();
            }
        }else{
            if($conyuge_x_trabajador -> es_trabajador == 1){
                $conyuge = Trabajador::where('id_trabajador', '=', $conyuge_x_trabajador -> id_conyuge)->first();
            }else{
                $conyuge = Conyuge::where('id_conyuge', '=', $conyuge_x_trabajador -> id_conyuge)->first();
            }        
        } 
         
        return view('Trabajador.show', compact('trabajador', 'conyuge', 'conyuge_x_trabajador', 'padecimiento', 'antecedente', 'familiares'));
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
        $conyuge = null;        
        $trabajadoresactivos = Trabajador::orderBy('id_trabajador')->paginate(50);
        $estadosciviles = EstadoCivil::orderBy('id_estado_civil')->paginate(50);
        $estados = Estado::orderBy('id_estado')->paginate(50);
        $municipios = Municipio::orderBy('id_estado_municipio')->paginate(50);
        $religiones = Religion::orderBy('id_religion')->paginate(50);
        $parentescos = Parentesco::orderBy('id_parentesco')->paginate(50);
        $roles = Rol::orderBy('id_rol')->paginate(50);
        $familiares = Familiar_trabajador::where('id_trabajador', '=' ,$id)->get();
        $escolaridades = Escolaridad::orderBy('escolaridad') -> paginate(50);
        $prep_academicas = PrepAcademica::orderBy('grado_academico') -> paginate(50);

        $trabajador = Trabajador::findOrFail($id);

        $conyuge_x_trabajador = conyuge_x_trabajador::where('id_trabajador', '=' ,$id)->first();
        $padecimiento = Padecimiento::where('id_trabajador', '=' ,$trabajador -> id_trabajador)->first(); 
        $antecedente = AntecedenteLaboral::where('id_trabajador', '=', $id)->first();
        
        if(($conyuge_x_trabajador != null) && ($conyuge_x_trabajador -> es_trabajador == 0)){
            $conyuge = Conyuge::findOrFail($conyuge_x_trabajador -> id_conyuge);
        }

        return view('Trabajador.edit', compact('trabajador', 'trabajadoresactivos', 'estadosciviles', 'estados', 'municipios', 'religiones', 'roles', 'conyuge_x_trabajador', 'conyuge', 'padecimiento', 'antecedente', 'familiares', 'parentescos', 'escolaridades', 'prep_academicas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrabajadorRequest $request, $id)
    {
        //
        $trabajador = Trabajador::findOrFail($id);
        $trabajador -> nombre = $request -> nombre;
        $trabajador -> a_paterno = $request -> a_paterno;
        $trabajador -> a_materno = $request -> a_materno;
        $trabajador -> curp = strtoupper($request -> curp);
        $trabajador -> rfc = $request -> rfc;
        $trabajador -> seguro_social = $request -> seguro_social;
        $trabajador -> id_estado_civil = $request -> id_estado_civil;
        $trabajador -> id_estado_municipio = $request -> id_estado_municipio;
        $trabajador -> extranjero = $request -> extranjero;
        $trabajador -> calle = $request -> calle;
        $trabajador -> numero_interior = $request -> numero_interior;
        $trabajador -> numero_exterior = $request -> numero_exterior;
        $trabajador -> colonia = $request -> colonia;
        $trabajador -> cp = $request -> cp;
        $trabajador -> telefono = $request -> telefono;
        $trabajador -> email = $request -> email;
        $trabajador -> id_religion = $request -> id_religion;
        $trabajador -> tipo_sangre = $request -> tipo_sangre;
        $trabajador -> id_prep_academica = $request -> id_prep_academica;
        $trabajador -> area_conocimiento = $request -> area_conocimiento;
        //if( $request -> id_escolaridad != 0 )
        $trabajador -> id_escolaridad = $request -> id_escolaridad;
        
        if($request -> hasFile('foto'))
            $trabajador -> foto = $request -> file('foto') -> storeAs('public/trabajadores', $request -> curp.'.jpeg');
        $guardado = $trabajador -> save();

        $this -> deleteConyuges($id);

        if(($request -> has('nombre_conyuge')) && ($request -> nombre_conyuge != 'NA') && ($request -> id_conyuge != -1)){
            $conyuge = new Conyuge;
            $conyuge -> nombre = $request -> nombre_conyuge;
            $conyuge -> a_paterno = $request -> a_paterno_conyuge;
            $conyuge -> a_materno = $request -> a_materno_conyuge;
            $conyuge -> genero = $request -> genero_conyuge;
            $conyuge -> fecha_nacimiento = $request -> fecha_de_nacimiento_conyuge;
            $conyuge -> lugar_labora = $request -> lugar_labora_conyuge;
            $conyuge -> save();

            $conyuge_x_trabajador = new conyuge_x_trabajador;
            $conyuge_x_trabajador -> id_trabajador = DB::table('trabajadors')->max('id_trabajador');
            $conyuge_x_trabajador -> id_conyuge = DB::table('conyuges')->max('id_conyuge');
            $conyuge_x_trabajador -> es_trabajador = 0;
            $conyuge_x_trabajador -> save();
        }else if(($request -> has('nombre_conyuge')) && ($request -> nombre_conyuge == 'NA') && ($request -> id_conyuge != -1)){
            $conyuge_x_trabajador = new conyuge_x_trabajador;
            $conyuge_x_trabajador -> id_trabajador = DB::table('trabajadors')->max('id_trabajador');
            $conyuge_x_trabajador -> id_conyuge = $request -> id_conyuge;
            $conyuge_x_trabajador -> es_trabajador = 1;
            $conyuge_x_trabajador -> save();
        }

        $padecimiento = Padecimiento::where('id_trabajador', '=', $id) -> first();
        $padecimiento -> alergia = $request -> alergia;
        $padecimiento -> enfermedad = $request -> enfermedad;
        $padecimiento -> cirugia = $request -> cirugia;
        $padecimiento -> medicina = $request -> medicina;
        $padecimiento -> medico = $request -> medico;
        $padecimiento -> tel_medico = $request -> telefono_medico;
        $padecimiento -> ref1_nombre = $request -> nombre_referencia1;
        $padecimiento -> ref1_tel = $request -> telefono_referencia1;
        $padecimiento -> ref1_nombre = $request -> nombre_referencia1;
        $padecimiento -> ref1_tel = $request -> telefono_referencia1;
        $padecimiento -> save();

        $this -> deleteFamiliares($id);

        for($i = 0; $i < count($request -> nombre_familiar); $i++) {
            $fam = new Familiar_trabajador;
            $fam -> id_trabajador = $id;
            $fam -> nombre = $request -> nombre_familiar[$i];
            $fam -> a_paterno = $request -> a_paterno_familiar[$i];
            $fam -> a_materno = $request -> a_materno_familiar[$i];
            $fam -> id_parentesco = $request -> id_parentesco_familiar[$i];
            $fam -> fecha_nacimiento = $request -> fecha_nacimiento_familiar[$i];
            $fam -> id_estado_civil = $request -> id_estado_civil_familiar[$i];
            $fam -> ocupacion = $request -> ocupacion_familiar[$i];
            if(!isset($request -> vive_familiar[$i]))
                $fam -> vive = 0;
            else
                $fam -> vive = $request -> vive_familiar[$i];
            $fam -> save();
        }

        $antecedente = AntecedenteLaboral::where('id_trabajador', '=', $id) -> first();
        if(!isset($request -> sin_experiencia)){
            $antecedente -> sin_experiencia = 0; 
            $antecedente -> trabajo_anterior = $request -> trabajo_anterior;
            $antecedente -> puesto = $request -> puesto;
            $antecedente -> inicio = $request -> fecha_inicio;
            $antecedente -> termino = $request -> fecha_termino;
        }else{
            $antecedente -> sin_experiencia = $request -> sin_experiencia;
        }
        $antecedente -> save();

        if($guardado)
            return redirect()->route('Trabajador.index')->with('info','Trabajador actualizado con éxito.');
        else
            return redirect()->route('Trabajador.index')->with('error','Imposible guardar Trabajador.');
    }

    public function deleteConyuges($id){
        $conyuge_temporal = conyuge_x_trabajador::where('id_trabajador', '=', $id)->first();
        if($conyuge_temporal != null){
            conyuge_x_trabajador::destroy($conyuge_temporal -> id);
            if($conyuge_temporal -> es_trabajador == 0){
                Conyuge::destroy($conyuge_temporal -> id_conyuge);
            }
        }
    }

    public function deleteFamiliares($id){
        $familiares_temporales = Familiar_trabajador::where('id_trabajador', '=', $id)->get();
        if($familiares_temporales != null){
            foreach ($familiares_temporales as $familiar_temporal) {
                $familiar_temporal -> delete();
            }
        }
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
        $conyuge_x_trabajador = conyuge_x_trabajador::where('id_trabajador', '=' ,$id)->first();
        $trabajador = Trabajador::findOrFail($id);
        Storage::delete($trabajador -> foto);

        if($conyuge_x_trabajador == null){
            $conyuge_x_trabajador = conyuge_x_trabajador::where('id_conyuge', '=' ,$id)->first();
            if($conyuge_x_trabajador != null){
                conyuge_x_trabajador::destroy($conyuge_x_trabajador -> id);
            }
        }else{
            if($conyuge_x_trabajador -> es_trabajador == 0){
                Conyuge::destroy($conyuge_x_trabajador -> id_conyuge);
            }  
            conyuge_x_trabajador::destroy($conyuge_x_trabajador -> id);     
        }

        $trabajador -> padecimiento() -> delete();
        $trabajador -> antecedenteLaboral() -> delete();

        $destruido = Trabajador::destroy($id);
        if($destruido)
            return redirect()->route('Trabajador.index')->with('info','Trabajador eliminado con éxito.');
        else
            return redirect()->route('Trabajador.index')->with('error','Imposible borrar Trabajador.');
    }

    public function addUser(Request $request){
        $user = new User;
        $trabajador = Trabajador::find(DB::table('trabajadors')->max('id_trabajador'));
        $user -> id_trabajador = $trabajador -> id_trabajador;
        $user -> name = $request -> nombre.' '.$request -> a_paterno.' '.$request -> a_materno;
        $user -> email = $request -> email;
        $user -> password = bcrypt(substr($request -> curp, 0, 6));
        $user -> photo = $trabajador -> foto;
        $user -> save();
        $user -> roles() -> attach($request -> id_rol);
    }
}