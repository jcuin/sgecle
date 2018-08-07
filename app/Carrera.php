<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Carrera extends Model
{
    //
    protected $table = 'cat_carreras';
    protected $primaryKey = 'id_carrera';

    use Sortable;

	public $sortable = ['id_carrera', 'nombre_carrera', 'nombre_reducido', 'siglas'];

    protected $fillable = [
            'nombre_carrera',
            'nombre_reducido',
            'siglas'
    ];

    public function trabajadores()
    {
        return $this->hasMany(Alumno::class,'id_alumno');
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class,'id_alumno');
    }
}
