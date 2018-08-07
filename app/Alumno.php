<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Alumno extends Model
{
    //
    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';

    use Sortable;

    public $sortable = ['id_alumno', 'nombre', 'a_paterno', 'a_materno', 'telefono', 'email'];

    protected $fillable = [
            'nombre',
            'a_paterno',
            'a_materno',
            'padre_o_tutor',
            'telefono',
            'sexo',
            'fecha_nacimiento',
            'padecimientos',
            'trabajador',
            'hijo_trabajador',
            'no_control'
    ];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class,'id_inscripcion');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class,'id_carrera');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class,'id_notificacion');
    }
}
