<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente_alumno extends Model
{
    //
    protected $table = 'expediente_alumnos';
    protected $primaryKey = 'id_expediente';

    protected $fillable = [
        'acta_nacimiento',
        'obs_acta',
        'curp',
        'obs_curp',
        'cartilla_vacunacion',
        'obs_cartilla',
        'certificado_medico',
        'obs_cert_medico',
        'constancia_estudios',
        'obs_constancia',
        'curp_padre',
        'obs_curp_padre',
        'curp_madre',
        'obs_curp_madre',
        'ife_padre',
        'obs_ife_padre',
        'ife_madre',
        'obs_ife_madre',
        'comp_domicilio',
        'obs_comp_domicilio',
        'boleta_anterior',
        'obs_boleta_anterior',
        'carta_conducta',
        'obs_carta_conducta',
        'cert_primaria',
        'obs_cert_primaria',
        'boletas_anteriores',
        'obs_boletas_anteriores',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class,'id_alumno');
    }
}

