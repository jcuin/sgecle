<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padecimiento extends Model
{
    //
    protected $table = 'padecimientos';
    protected $primaryKey = 'id_padecimiento';

    protected $fillable = [
        'alergia',
        'enfermedad',
        'medicina',
        'medico',
        'tel_medico',
        'ref1_nombre',
        'ref1_tel',
        'ref2_nombre',
        'ref2_tel',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class,'id_alumno');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class,'id_trabajador');
    }
}
