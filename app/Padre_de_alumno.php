<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padre_de_alumno extends Model
{
    //
    protected $table = 'padres_de_alumnos';
    protected $primaryKey = 'id_padres_alumno';

    protected $fillable = [
        'nombre',
        'a_paterno',
        'a_materno',
        'empleo',
        'puesto',
        'direccion',
        'tel_trabajo',
        'celular',
        'nextel',
    ];
}
