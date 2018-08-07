<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Setting;
use App\Periodo;

class SettingController extends Controller
{
    //
    /*function __construct(){
        $this -> middleware(['auth', 'roles:dir_general']);
    }*/

    public function index()
    {
        //
        $setting = Setting::find(1);

        //dd($setting -> periodo);
        
        return view('Setting.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        //
        $Setting = new Setting;
        $Setting -> Setting = $request -> Setting;
        $guardado = $Setting -> save();
        if($guardado)
            return redirect()->route('Setting.index')->with('info','Religión creada con éxito.');
        else
            return redirect()->route('Setting.index')->with('error','Imposible guardar Religión.');
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
        $Setting = Setting::findOrFail($id);
        return view('Setting.show', compact('Setting'));
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
        $setting = Setting::findOrFail($id);
        $periodos = Periodo::orderBy('id_periodo')->paginate(50);
        return view('Setting.edit', compact('setting', 'periodos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        //
        $setting = Setting::findOrFail($id);
        $setting -> clave_preescolar = $request -> clave_preescolar;
        $setting -> clave_primaria = $request -> clave_primaria;
        $setting -> clave_secundaria = $request -> clave_secundaria;
        $setting -> zona_escolar = $request -> zona_escolar;
        $setting -> rfc_colegio = $request -> rfc_colegio;
        $setting -> razon_social = $request -> razon_social;
        $setting -> domicilio = $request -> domicilio;
        $setting -> telefono_contacto = $request -> telefono_contacto;
        $setting -> correo_electronico = $request -> correo_electronico;
        $setting -> id_periodo = $request -> id_periodo;
        $setting -> direccion_general = $request -> direccion_general;
        $setting -> direccion_preescolar = $request -> direccion_preescolar;
        $setting -> direccion_primaria = $request -> direccion_primaria;
        $setting -> direccion_secundaria = $request -> direccion_secundaria;
        $setting -> direccion_ingles = $request -> direccion_ingles;
        $setting -> costo_colegiatura = $request -> costo_colegiatura;
        $guardado = $setting -> save();

        if($guardado)
            return redirect()->route('Setting.index')->with('info','Configuración actualizada con éxito.');
        else
            return redirect()->route('Setting.index')->with('error','Imposible actualizar Configuración.');
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
        $destruido = Setting::destroy($id);
        if($destruido)
            return redirect()->route('Setting.index')->with('info','Religión eliminada con éxito.');
        else
            return redirect()->route('Setting.index')->with('error','Imposible borrar Religión.');
    }
}
