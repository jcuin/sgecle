<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Municipio extends Model
{
    //
    protected $table = 'cat_municipios';
    protected $primaryKey = 'id_estado_municipio';

    use Sortable;

	public $sortable = ['id_estado_municipio', 'id_estado', 'id_municipio', 'municipio'];

    public function estado()
    {
        return $this->belongsTo(Estado::class,'id_estado');
    }

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class,'id_trabajador');
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class,'id_alumno');
    }

    protected static function boot() {
        parent::boot();
        static::deleted(function($municipio) {
            $municipio -> trabajadores() -> delete();
        });
    }
}


