<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Inscripcion extends Model
{
    //
    protected $table = 'inscripciones';
    protected $primaryKey = 'id_inscripcion';

    use Sortable;

	public $sortable = ['id_grupo', 'grupo'];

	public function alumno()
    {
        return $this->belongsTo(Alumno::class,'id_alumno');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'id_grupo');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class,'id_materia');
    }
}
