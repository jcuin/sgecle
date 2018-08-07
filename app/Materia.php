<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Materia extends Model
{
    //
    protected $table = 'cat_materias';
    protected $primaryKey = 'id_materia';

    use Sortable;

	public $sortable = ['id_materia', 'materia'];

    protected $fillable = [
            'materia'
    ];

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class,'materia_x_grupos', 'id_grupo', 'id_materia')->withTimestamps();
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class,'id_inscripcion');
    }
}
