<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Trabajador extends Model
{
    //
    protected $table = 'trabajadores';
    protected $primaryKey = 'id_trabajador';

    use Sortable;

    public $sortable = ['id_trabajador', 'nombre', 'a_paterno', 'a_materno', 'curp', 'rfc', 'telefono', 'email', 'id_rol'];

    protected $fillable = [
		'nombre',
        'a_paterno',
        'a_materno',
        'curp',        
        'extranjero',      
        'calle',
        'numero_interior',
        'numero_exterior',
        'colonia',
        'cp',
        'telefono',
        'tipo_sangre'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class,'id_estado_municipio');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class,'id_estado_civil');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class,'id_religion');
    }

    public function padecimiento()
    {
        return $this->hasOne(Padecimiento::class,'id_padecimiento');
    }

    public function antecedenteLaboral()
    {
        return $this->hasOne(AntecedenteLaboral::class,'id_antecedente_laboral');
    }

    public function familiar()
    {
        return $this->hasMany(Familiar_trabajador::class,'id_trabajador');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id_trabajador');
    }

    public function mensajesEmitidos()
    {
        return $this->hasMany(Notificacion::class,'id_trabajador_emisor');
    }

    public function mensajesRecibidos()
    {
        return $this->hasMany(Notificacion::class,'id_trabajador_destino');
    }

    public function gradoAcademico()
    {
        return $this->belongsTo(PrepAcademica::class,'id_prep_academica');
    }

    public function adscripcion()
    {
        return $this->belongsTo(Escolaridad::class,'id_escolaridad');
    }

    public function planeaciones()
    {
        return $this->hasMany(Planeacion::class,'id_trabajador');
    }
}
