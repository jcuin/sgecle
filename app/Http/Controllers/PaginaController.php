<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaginaRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Pagina;
use App\Pagina_convenios;
use App\Pagina_horarios;
use App\Pagina_instalaciones;
use App\Pagina_oferta;
use App\Pagina_talleres;
use App\Informe;
use DB;
use DateTime;

class PaginaController extends Controller
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

        $paginas = Pagina::paginate(10);
        
        return view('Pagina.index', compact('paginas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Pagina.create');
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
        //dd($request );
        $pagina = new Pagina;
        $pagina -> descripcion = $request -> descripcion;
        if($request -> hasFile('banner_principal_imagen')){
            $pagina -> banner_principal_imagen = $request -> file('banner_principal_imagen') -> storeAs('public/pagina/banner_principal', $request -> file('banner_principal_imagen') -> getClientOriginalName());
        }
        for($i = 0; $i < count($request -> banner_principal_texto); $i ++){
            $pagina -> banner_principal_texto = $pagina -> banner_principal_texto.'&'.$request -> banner_principal_texto[$i];
        }   
        $pagina -> instalaciones_titulo = $request -> instalaciones_titulo;
        $pagina -> instalaciones_texto = $request -> instalaciones_texto;
        $pagina -> horario_titulo = $request -> horario_titulo;
        $pagina -> horario_texto = $request -> horario_texto;
        $pagina -> taller_encabezado = $request -> taller_encabezado;
        $pagina -> desde = new DateTime();
        $pagina->save();

        $maxid = DB::table('pagina')->max('id');
        
        $i = 0;
        foreach(Input::file('convenio_imagen') as $file){
            $pagina_convenios = new Pagina_convenios;
            $pagina_convenios -> id_pagina = $maxid;
            $pagina_convenios -> convenio_imagen = $file -> storeAs('public/pagina/convenio', $maxid.'_'.$file -> getClientOriginalName());
            $pagina_convenios -> convenio_titulo = $request -> convenio_titulo[$i];
            $pagina_convenios -> save();
            $i++;
        }

        $i = 0;
        foreach(Input::file('horario_imagen') as $file){
            $pagina_horarios = new Pagina_horarios;
            $pagina_horarios -> id_pagina = $maxid;
            $pagina_horarios -> horario_imagen = $file -> storeAs('public/pagina/horario', $maxid.'_'.$file -> getClientOriginalName());
            $pagina_horarios -> horario_titulo_imagen = $request -> horario_titulo_imagen[$i];
            $pagina_horarios -> horario_texto_imagen = $request -> horario_texto_imagen[$i];
            $pagina_horarios -> save();
            $i++;
        }

        $i = 0;
        foreach(Input::file('instalaciones_imagen') as $file){
            $pagina_instalaciones = new Pagina_instalaciones;
            $pagina_instalaciones -> id_pagina = $maxid;
            $pagina_instalaciones -> instalaciones_imagen = $file -> storeAs('public/pagina/instalaciones', $maxid.'_'.$file -> getClientOriginalName());
            $pagina_instalaciones -> instalaciones_titulo_imagen = $request -> instalaciones_titulo_imagen[$i];
            $pagina_instalaciones -> instalaciones_texto_imagen = $request -> instalaciones_texto_imagen[$i];
            $pagina_instalaciones -> save();
            $i++;
        }

        $i = 0;
        foreach(Input::file('oferta_imagen') as $file){
            $pagina_oferta = new Pagina_oferta;
            $pagina_oferta -> id_pagina = $maxid;
            $pagina_oferta -> oferta_imagen = $file -> storeAs('public/pagina/oferta', $maxid.'_'.$file -> getClientOriginalName());
            $pagina_oferta -> oferta_titulo = $request -> oferta_titulo[$i];
            $pagina_oferta -> oferta_texto = $request -> oferta_texto[$i];
            $pagina_oferta -> save();
            $i++;
        }        
        
        $i = 0;
        foreach(Input::file('talleres_imagen') as $file){
            $pagina_talleres = new Pagina_talleres;
            $pagina_talleres -> id_pagina = $maxid;
            $pagina_talleres -> talleres_imagen = $file -> storeAs('public/pagina/talleres', $maxid.'_'.$file -> getClientOriginalName());
            $pagina_talleres -> talleres_titulo = $request -> talleres_titulo[$i];
            $pagina_talleres -> talleres_texto = $request -> talleres_texto[$i];
            $pagina_talleres -> save();
            $i++;
        }
        return redirect() -> route('Pagina.index') -> with('info','Página actualizada con éxito.');
    }

    public function storeInforme(InformeRequest $request)
    {
        //
        $informe = new Informe;
        $informe -> nombre = $request -> nombre;
        $informe -> email = $request -> email;
        $informe -> telefono = $request -> telefono;
        $informe -> asunto = $request -> asunto;
        $informe -> mensaie = $request -> mensaje;
        $informe -> id_escolaridad = $request -> id_escolaridad;
        $informe -> enterado_a_traves_de = $request -> enterado;
        $informe -> save();

        return redirect() -> route('inicio') -> with('info','Gracias por contactarnos. Nos comunicaremos contigo a la brevedad posible.');
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
        $pagina = Pagina::findOrFail($id);
        $banner_principal_texto = explode('&', $pagina -> banner_principal_texto);
        $pagina_convenios = Pagina_convenios::where('id_pagina', $id)->get();
        $pagina_horarios = Pagina_horarios::where('id_pagina', $id)->get();
        $pagina_instalaciones = Pagina_instalaciones::where('id_pagina', $id)->get();
        $pagina_oferta = Pagina_oferta::where('id_pagina', $id)->get();
        $pagina_talleres = Pagina_talleres::where('id_pagina', $id)->get();

        return view('Pagina.show', compact('pagina','banner_principal_texto', 'pagina_convenios', 'pagina_horarios', 'pagina_instalaciones', 'pagina_oferta', 'pagina_talleres'));
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
    public function update($id)
    {
        //
    }
    public function editarPagina($id)
    {
        //
        $pagina = Pagina::findOrFail($id);
        $banner_principal_texto = explode('&', $pagina -> banner_principal_texto);

        return view('Pagina.editPagina', compact('id','pagina','banner_principal_texto'));
    }
    public function editarOferta($id)
    {
        //
        $pagina_oferta = Pagina_oferta::where('id_pagina', $id)->get();
        
        return view('Pagina.editOferta', compact('id','pagina_oferta'));
    }
    public function editarTaller($id)
    {
        //
        $pagina = Pagina::findOrFail($id);
        $pagina_taller = Pagina_talleres::where('id_pagina', $id)->get();
        
        return view('Pagina.editTaller', compact('id','pagina','pagina_taller'));
    }
    public function editarInstalacion($id)
    {
        //
        $pagina = Pagina::findOrFail($id);
        $pagina_instalacion = Pagina_instalaciones::where('id_pagina', $id)->get();
        
        return view('Pagina.editInstalacion', compact('id','pagina','pagina_instalacion'));
    }
    public function editarHorario($id)
    {
        //
        $pagina = Pagina::findOrFail($id);
        $pagina_horario = Pagina_horarios::where('id_pagina', $id)->get();
        
        return view('Pagina.editHorario', compact('id','pagina','pagina_horario'));
    }
    public function editarConvenio($id)
    {
        //
        $pagina = Pagina::findOrFail($id);
        $pagina_convenio = Pagina_convenios::where('id_pagina', $id)->get();
        
        return view('Pagina.editConvenio', compact('id','pagina','pagina_convenio'));
    }
    public function updatePagina(Request $request)
    {
        //
        $id = $request -> id_pagina;
        $pagina = Pagina::findOrFail($id);
        $pagina -> descripcion = $request -> descripcion;
        if($request -> hasFile('banner_principal_imagen')){
            $pagina -> banner_principal_imagen = $request -> file('banner_principal_imagen') -> storeAs('public/pagina/banner_principal', $request -> file('banner_principal_imagen') -> getClientOriginalName());
        }
        $pagina -> banner_principal_texto = "";
        for($i = 0; $i < count($request -> banner_principal_texto); $i ++){
            $pagina -> banner_principal_texto = $pagina -> banner_principal_texto.'&'.$request -> banner_principal_texto[$i];
        }
        
        if($pagina -> save())
            return redirect() -> route('Pagina.show', compact('id')) -> with('info','Banner Principal actualizado con éxito.');
        else
            return redirect() -> route('Pagina.show', compact('id')) -> with('error','Imposible actualizar Banner Principal.');
    }
    public function updateOferta(Request $request)
    {
        // 
        $id = $request -> id_pagina;
        $pagina = Pagina::findOrFail($id);

        //cambios en la imagen de los ya registrados
        $resumen_propuestas = explode('-',$request -> resumen_propuestas);
        $resumen_propuestas = array_filter($resumen_propuestas, 'strlen');
        $imagenes = array();
        for($i = 0; $i < count($request -> oferta_titulo); $i++){
            if(isset($request -> oferta_imagen[$i])){
                array_push($imagenes, $i);
            }
        }
        if(count($resumen_propuestas) > 0){
            for($i = 0; $i < count($resumen_propuestas); $i++){
                $pagina_oferta = Pagina_oferta::findOrFail($resumen_propuestas[$i]);
                Storage::delete($pagina_oferta -> oferta_imagen[intval($imagenes[$i])]);
                $pagina_oferta -> oferta_imagen = $request -> oferta_imagen[intval($imagenes[$i])] -> storeAs('public/pagina/oferta',$request -> oferta_imagen[intval($imagenes[$i])] -> getClientOriginalName());
                $pagina_oferta -> oferta_titulo = $request -> oferta_titulo[$i];
                $pagina_oferta -> oferta_texto = $request -> oferta_texto[$i];
                $pagina_oferta -> save();
            }
        }

        //sin cambios en la imagen, sólo en el texto
        for($i = 0; $i < count($request -> id_oculto); $i++){
            $pagina_oferta = Pagina_oferta::findOrFail($request -> id_oculto[$i]);
            $pagina_oferta -> oferta_titulo = $request -> oferta_titulo[$i];
            $pagina_oferta -> oferta_texto = $request -> oferta_texto[$i];
            $pagina_oferta -> save();
        }
        
        //registro de los nuevos
        $nuevas_ofertas = $request -> oferta_nuevo_titulo;
        $nuevas_imagenes = explode('-',$request -> resumen_nuevas_propuestas);
        $nuevas_imagenes = array_filter($nuevas_imagenes, 'strlen');
        if(isset($nuevas_imagenes[0]) && $nuevas_imagenes[0] != null){
            if(count($nuevas_ofertas) > 0){
                for($i = 1; $i < count($nuevas_ofertas); $i++){
                    if($request -> file('oferta_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) != null){
                        $pagina_oferta = new Pagina_oferta;
                        $pagina_oferta -> id_pagina = $id;
                        $pagina_oferta -> oferta_imagen = $request -> file('oferta_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> storeAs('public/pagina/oferta',$request -> file('oferta_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> getClientOriginalName());
                        $pagina_oferta -> oferta_titulo = $request -> oferta_nuevo_titulo[$i];
                        $pagina_oferta -> oferta_texto = $request -> oferta_nuevo_texto[$i];
                        $pagina_oferta -> save();
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
                    $pagina_oferta = Pagina_oferta::findOrFail($resumen_borrados[$i]);
                    Storage::delete($pagina_oferta -> oferta_imagen);
                    $pagina_oferta = Pagina_oferta::destroy($resumen_borrados[$i]);
                }
            }
        }

        return redirect() -> route('Pagina.show', compact('id')) -> with('info','Oferta actualizada con éxito.');
    }
    public function updateTaller(Request $request)
    {
        // 
        $id = $request -> id_pagina;
        $pagina = Pagina::findOrFail($id);
        $pagina -> taller_encabezado = $request -> taller_encabezado;
        $pagina -> save();

        //cambios en la imagen de los ya registrados
        $resumen_propuestas = explode('-',$request -> resumen_propuestas);
        $resumen_propuestas = array_filter($resumen_propuestas, 'strlen');
        $imagenes = array();
        for($i = 0; $i < count($request -> talleres_titulo); $i++){
            if(isset($request -> talleres_imagen[$i])){
                array_push($imagenes, $i);
            }
        }
        if(count($resumen_propuestas) > 0){
            for($i = 0; $i < count($resumen_propuestas); $i++){
                $pagina_taller = Pagina_talleres::findOrFail($resumen_propuestas[$i]);
                Storage::delete($pagina_taller -> talleres_imagen[intval($imagenes[$i])]);
                $pagina_taller -> talleres_imagen = $request -> talleres_imagen[intval($imagenes[$i])] -> storeAs('public/pagina/talleres',$request -> talleres_imagen[intval($imagenes[$i])] -> getClientOriginalName());
                $pagina_taller -> talleres_titulo = $request -> talleres_titulo[$i];
                $pagina_taller -> talleres_texto = $request -> talleres_texto[$i];
                $pagina_taller -> save();
            }
        }

        //sin cambios en la imagen, sólo en el texto
        for($i = 0; $i < count($request -> id_oculto); $i++){
            $pagina_taller = Pagina_talleres::findOrFail($request -> id_oculto[$i]);
            $pagina_taller -> talleres_titulo = $request -> talleres_titulo[$i];
            $pagina_taller -> talleres_texto = $request -> talleres_texto[$i];
            $pagina_taller -> save();
        }

        //registro de los nuevos
        $nuevos_talleres = $request -> talleres_nuevo_titulo;
        $nuevas_imagenes = explode('-',$request -> resumen_nuevas_propuestas);
        $nuevas_imagenes = array_filter($nuevas_imagenes, 'strlen');
        if(isset($nuevas_imagenes[0]) && $nuevas_imagenes[0] != null){
            if(count($nuevos_talleres) > 0){
                for($i = 1; $i < count($nuevos_talleres); $i++){
                    if($request -> file('talleres_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) != null){
                        $pagina_taller = new Pagina_talleres;
                        $pagina_taller -> id_pagina = $id;
                        $pagina_taller -> talleres_imagen = $request -> file('talleres_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> storeAs('public/pagina/talleres',$request -> file('talleres_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> getClientOriginalName());
                        $pagina_taller -> talleres_titulo = $request -> talleres_nuevo_titulo[$i];
                        $pagina_taller -> talleres_texto = $request -> talleres_nuevo_texto[$i];
                        $pagina_taller -> save();
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
                    $pagina_taller = Pagina_talleres::findOrFail($resumen_borrados[$i]);
                    Storage::delete($pagina_taller -> talleres_imagen);
                    $pagina_taller = Pagina_talleres::destroy($resumen_borrados[$i]);
                }
            }
        }

        return redirect() -> route('Pagina.show', compact('id')) -> with('info','Talleres actualizados con éxito.');
    }
    public function updateInstalacion(Request $request)
    {
        // 
        $id = $request -> id_pagina;
        $pagina = Pagina::findOrFail($id);
        $pagina -> instalaciones_titulo = $request -> instalaciones_titulo;
        $pagina -> instalaciones_texto = $request -> instalaciones_texto;
        $pagina -> save();

        //cambios en la imagen de los ya registrados
        $resumen_propuestas = explode('-',$request -> resumen_propuestas);
        $resumen_propuestas = array_filter($resumen_propuestas, 'strlen');
        $imagenes = array();
        for($i = 0; $i < count($request -> instalaciones_titulo_imagen); $i++){
            if(isset($request -> instalaciones_imagen[$i])){
                array_push($imagenes, $i);
            }
        }
        if(count($resumen_propuestas) > 0){
            for($i = 0; $i < count($resumen_propuestas); $i++){
                $pagina_instalacion = Pagina_instalaciones::findOrFail($resumen_propuestas[$i]);
                Storage::delete($pagina_instalacion -> instalaciones_imagen[intval($imagenes[$i])]);
                $pagina_instalacion -> instalaciones_imagen = $request -> instalaciones_imagen[intval($imagenes[$i])] -> storeAs('public/pagina/instalaciones',$request -> instalaciones_imagen[intval($imagenes[$i])] -> getClientOriginalName());
                $pagina_instalacion -> instalaciones_titulo_imagen = $request -> instalaciones_titulo_imagen[$i];
                $pagina_instalacion -> instalaciones_texto_imagen = $request -> instalaciones_texto_imagen[$i];
                $pagina_instalacion -> save();
            }
        }

        //sin cambios en la imagen, sólo en el texto
        for($i = 0; $i < count($request -> id_oculto); $i++){
            $pagina_instalacion = Pagina_instalaciones::findOrFail($request -> id_oculto[$i]);
            $pagina_instalacion -> instalaciones_titulo_imagen = $request -> instalaciones_titulo_imagen[$i];
            $pagina_instalacion -> instalaciones_texto_imagen = $request -> instalaciones_texto_imagen[$i];
            $pagina_instalacion -> save();
        }
        
        //registro de los nuevos
        $nuevas_instalaciones = $request -> instalaciones_nuevo_titulo_imagen;
        $nuevas_imagenes = explode('-',$request -> resumen_nuevas_propuestas);
        $nuevas_imagenes = array_filter($nuevas_imagenes, 'strlen');
        if(isset($nuevas_imagenes[0]) && $nuevas_imagenes[0] != null){
            if(count($nuevas_instalaciones) > 0){
                for($i = 1; $i < count($nuevas_instalaciones); $i++){
                    if($request -> file('instalaciones_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) != null){
                        $pagina_instalacion = new Pagina_instalaciones;
                        $pagina_instalacion -> id_pagina = $id;
                        $pagina_instalacion -> instalaciones_imagen = $request -> file('instalaciones_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> storeAs('public/pagina/instalaciones',$request -> file('instalaciones_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> getClientOriginalName());
                        $pagina_instalacion -> instalaciones_titulo_imagen = $request -> instalaciones_nuevo_titulo_imagen[$i];
                        $pagina_instalacion -> instalaciones_texto_imagen = $request -> instalaciones_nuevo_texto_imagen[$i];
                        $pagina_instalacion -> save();
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
                    $pagina_instalacion = Pagina_instalaciones::findOrFail($resumen_borrados[$i]);
                    Storage::delete($pagina_instalacion -> talleres_imagen);
                    $pagina_instalacion = Pagina_talleres::destroy($resumen_borrados[$i]);
                }
            }
        }

        return redirect() -> route('Pagina.show', compact('id')) -> with('info','Instalaciones actualizadas con éxito.');
    }
    public function updateHorario(Request $request)
    {
        // 
        $id = $request -> id_pagina;
        $pagina = Pagina::findOrFail($id);
        $pagina -> horario_titulo = $request -> horario_titulo;
        $pagina -> horario_texto = $request -> horario_texto;
        $pagina -> save();

        //cambios en la imagen de los ya registrados
        $resumen_propuestas = explode('-',$request -> resumen_propuestas);
        $resumen_propuestas = array_filter($resumen_propuestas, 'strlen');
        $imagenes = array();
        for($i = 0; $i < count($request -> horario_titulo_imagen); $i++){
            if(isset($request -> horario_imagen[$i])){
                array_push($imagenes, $i);
            }
        }
        if(count($resumen_propuestas) > 0){
            for($i = 0; $i < count($resumen_propuestas); $i++){
                $pagina_horario = Pagina_horarios::findOrFail($resumen_propuestas[$i]);
                Storage::delete($pagina_horario -> horario_imagen[intval($imagenes[$i])]);
                $pagina_horario -> horario_imagen = $request -> horario_imagen[intval($imagenes[$i])] -> storeAs('public/pagina/instalaciones',$request -> horario_imagen[intval($imagenes[$i])] -> getClientOriginalName());
                $pagina_horario -> horario_titulo_imagen = $request -> horario_titulo_imagen[$i];
                $pagina_horario -> horario_texto_imagen = $request -> horario_texto_imagen[$i];
                $pagina_horario -> save();
            }
        }

        //sin cambios en la imagen, sólo en el texto
        for($i = 0; $i < count($request -> id_oculto); $i++){
            $pagina_horario = Pagina_horarios::findOrFail($request -> id_oculto[$i]);
            $pagina_horario -> horario_titulo_imagen = $request -> horario_titulo_imagen[$i];
            $pagina_horario -> horario_texto_imagen = $request -> horario_texto_imagen[$i];
            $pagina_horario -> save();
        }
        
        //registro de los nuevos
        $nuevos_horarios = $request -> horario_nuevo_titulo_imagen;
        $nuevas_imagenes = explode('-',$request -> resumen_nuevas_propuestas);
        $nuevas_imagenes = array_filter($nuevas_imagenes, 'strlen');
        if(isset($nuevas_imagenes[0]) && $nuevas_imagenes[0] != null){
            if(count($nuevos_horarios) > 0){
                for($i = 1; $i < count($nuevos_horarios); $i++){
                    if($request -> file('horario_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) != null){
                        $pagina_horario = new Pagina_horarios;
                        $pagina_horario -> id_pagina = $id;
                        $pagina_horario -> horario_imagen = $request -> file('horario_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> storeAs('public/pagina/horario',$request -> file('horario_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> getClientOriginalName());
                        $pagina_horario -> horario_titulo_imagen = $request -> horario_nuevo_titulo_imagen[$i];
                        $pagina_horario -> horario_texto_imagen = $request -> horario_nuevo_texto_imagen[$i];
                        $pagina_horario -> save();
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
                    $pagina_horario = Pagina_horarios::findOrFail($resumen_borrados[$i]);
                    Storage::delete($pagina_horario -> horario_imagen);
                    $pagina_horario = Pagina_horarios::destroy($resumen_borrados[$i]);
                }
            }
        }

        return redirect() -> route('Pagina.show', compact('id')) -> with('info','Horarios actualizados con éxito.');
    }
    public function updateConvenio(Request $request)
    {
        // 
        $id = $request -> id_pagina;
        $pagina = Pagina::findOrFail($id);
        $pagina -> save();

        //cambios en la imagen de los ya registrados
        $resumen_propuestas = explode('-',$request -> resumen_propuestas);
        $resumen_propuestas = array_filter($resumen_propuestas, 'strlen');
        $imagenes = array();
        for($i = 0; $i < count($request -> convenio_titulo); $i++){
            if(isset($request -> convenio_imagen[$i])){
                array_push($imagenes, $i);
            }
        }
        if(count($resumen_propuestas) > 0){
            for($i = 0; $i < count($resumen_propuestas); $i++){
                $pagina_convenio = Pagina_convenios::findOrFail($resumen_propuestas[$i]);
                Storage::delete($pagina_convenio -> convenio_imagen[intval($imagenes[$i])]);
                $pagina_convenio -> convenio_imagen = $request -> convenio_imagen[intval($imagenes[$i])] -> storeAs('public/pagina/convenio',$request -> convenio_imagen[intval($imagenes[$i])] -> getClientOriginalName());
                $pagina_convenio -> convenio_titulo = $request -> convenio_titulo[$i];
                $pagina_convenio -> save();
            }
        }

        //sin cambios en la imagen, sólo en el texto
        for($i = 0; $i < count($request -> id_oculto); $i++){
            $pagina_convenio = Pagina_convenios::findOrFail($request -> id_oculto[$i]);
            $pagina_convenio -> convenio_titulo = $request -> convenio_titulo[$i];
            $pagina_convenio -> save();
        }

        //registro de los nuevos
        $nuevos_convenio = $request -> convenio_nuevo_titulo;
        $nuevas_imagenes = explode('-',$request -> resumen_nuevas_propuestas);
        $nuevas_imagenes = array_filter($nuevas_imagenes, 'strlen');
        if(isset($nuevas_imagenes[0]) && $nuevas_imagenes[0] != null){
            if(count($nuevos_convenio) > 0){
                for($i = 1; $i < count($nuevos_convenio); $i++){
                    if($request -> file('convenio_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) != null){
                        $pagina_convenio = new Pagina_convenios;
                        $pagina_convenio -> id_pagina = $id;
                        $pagina_convenio -> convenio_imagen = $request -> file('convenio_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> storeAs('public/pagina/convenio',$request -> file('convenio_nueva_imagen_'.strval($nuevas_imagenes[$i-1])) -> getClientOriginalName());
                        $pagina_convenio -> convenio_titulo = $request -> convenio_nuevo_titulo[$i];
                        $pagina_convenio -> save();
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
                    $pagina_convenio = Pagina_convenios::findOrFail($resumen_borrados[$i]);
                    Storage::delete($pagina_convenio -> convenio_imagen);
                    $pagina_convenio = Pagina_convenio::destroy($resumen_borrados[$i]);
                }
            }
        }

        return redirect() -> route('Pagina.show', compact('id')) -> with('info','Convenios actualizados con éxito.');
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
        $pagina = Pagina::findOrFail($id);
        Storage::delete($pagina -> banner_principal_imagen);

        $pagina_oferta = Pagina_oferta::where('id_pagina', $id) -> get();
        foreach ($pagina_oferta as $individual_oferta) {
            Storage::delete($individual_oferta -> oferta_imagen);  
            Pagina_oferta::destroy($individual_oferta -> id);
        }

        $pagina_talleres = Pagina_talleres::where('id_pagina', $id) -> get();
        foreach ($pagina_talleres as $individual_talleres) {
            Storage::delete($individual_talleres -> talleres_imagen);  
            Pagina_talleres::destroy($individual_talleres -> id);
        }

        $pagina_instalaciones = Pagina_instalaciones::where('id_pagina', $id) -> get();
        foreach ($pagina_instalaciones as $individual_instalaciones) {
            Storage::delete($individual_instalaciones -> instalaciones_imagen);  
            Pagina_instalaciones::destroy($individual_instalaciones -> id);
        }

        $pagina_convenios = Pagina_convenios::where('id_pagina', $id) -> get();
        foreach ($pagina_convenios as $individual_convenios) {
            Storage::delete($individual_convenios -> convenio_imagen);  
            Pagina_convenios::destroy($individual_convenios -> id);
        }

        Pagina::destroy($id);

        return redirect()->route('Pagina.index')->with('info','Configuración de página eliminada con éxito.');
    }

    public function utilize(Request $request)
    {
        //
        $pagina_actual = Pagina::where('activo', 1) -> first();
        $pagina_actual -> hasta = new DateTime();
        $pagina_actual -> save();
        
        $paginas = Pagina::all();
        foreach ($paginas as $pagina) {
            $pagina -> activo = 0;
            $pagina -> save();
        }

        $pagina = Pagina::findOrFail($request -> id);
        $pagina -> activo = 1;
        $pagina -> desde = new DateTime();
        $pagina -> save();
        
        return redirect()->route('Pagina.index')->with('info','La Página ha sido actualizada con éxito.');
    }

    public function estadistica()
    {
        //
        $informes = DB::select(DB::raw("select count(id) as cantidad, cat_escolaridads.escolaridad as escolaridad 
            from informes
            inner join cat_escolaridads
            on informes.id_escolaridad = cat_escolaridads.id_escolaridad
            group by informes.id_escolaridad"));
            
        $etiquetas = array_column($informes, 'escolaridad');
        $cantidad = array_column($informes, 'cantidad');

        $medios = DB::select(DB::raw("select count(id) as cantidad, enterado_a_traves_de as medio
            from informes
            group by informes.enterado_a_traves_de"));

        $etiquetas_contacto = array_column($medios, 'medio');
        $cantidad_contacto = array_column($medios, 'cantidad');

        $visitas = DB::select(DB::raw("select count(id) as cantidad, MONTHNAME(created_at) as fecha from visitas 
            group by MONTH(created_at)"));

        $etiquetas_visitas = array_column($visitas, 'fecha');
        $cantidad_visitas = array_column($visitas, 'cantidad');

        /*$matricula = DB::select(DB::raw("select count(distinct inscripciones.id_alumno) as alumnos, cat_escolaridads.escolaridad, cat_periodos.periodo
            from inscripciones
            inner join cat_grupos
            on inscripciones.id_grupo = cat_grupos.id_grupo
            inner join cat_escolaridads 
            on cat_escolaridads.id_escolaridad = cat_grupos.id_escolaridad
            inner join cat_periodos
            on cat_periodos.id_periodo = cat_grupos.id_periodo
            group by cat_grupos.id_escolaridad, cat_periodos.id_periodo
            order by cat_periodos.id_periodo"));

        $etiquetas_matricula = array_column($matricula, 'escolaridad');
        $cantidad_matricula = array_column($matricula, 'alumnos');

        $prescolar = array();
        $primaria = array();
        $secundaria = array();

        foreach ($matricula as $unitario) {
            if($unitario -> escolaridad == 'prescolar')
                array_push($prescolar, $unitario -> prescolar);
            else if($unitario -> escolaridad == 'primaria') 
                array_push($primaria, $unitario -> primaria);
            else
                array_push($secundaria, $unitario -> secundaria);
        }*/
        
        /*$reprobados = array();

        $etiquetas_generos = array('Hombres', 'Mujeres');

        $hombres_mujeres = array();

        array_push($hombres_mujeres, $generos[0] -> hombres);
        array_push($hombres_mujeres, $generos[0] -> mujeres);

        foreach ($informes as $boleta) {
            array_push($reprobados, intval($inscritos[1]) - intval($boleta -> aprobados));
        }*/

        return view('Pagina.estadistica')
        ->with('cantidad', json_encode($cantidad, JSON_NUMERIC_CHECK))
        ->with('etiquetas', json_encode($etiquetas))
        ->with('cantidad_contacto', json_encode($cantidad_contacto, JSON_NUMERIC_CHECK))
        ->with('etiquetas_contacto', json_encode($etiquetas_contacto))
        ->with('cantidad_visitas', json_encode($cantidad_visitas, JSON_NUMERIC_CHECK))
        ->with('etiquetas_visitas', json_encode($etiquetas_visitas));
        /*->with('cantidad_matricula', json_encode($cantidad_matricula, JSON_NUMERIC_CHECK))
        ->with('prescolar', json_encode($prescolar, JSON_NUMERIC_CHECK))
        ->with('primaria', json_encode($primaria, JSON_NUMERIC_CHECK))
        ->with('secundaria', json_encode($secundaria, JSON_NUMERIC_CHECK))
        ->with('etiquetas_matricula', json_encode($etiquetas_matricula));*/
    }
}
