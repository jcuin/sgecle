<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Grupo extends Model
{
    //
    protected $table = 'cat_grupos';
    protected $primaryKey = 'id_grupo';

    use Sortable;

	public $sortable = ['id_grupo', 'grupo', 'capacidad'];

    protected $fillable = [
        'grupo',
        'capacidad'
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class,'id_periodo');
    }

    public function escolaridad()
    {
        return $this->belongsTo(Escolaridad::class,'id_escolaridad');
    }

    public function materias()
    {
        return $this->belongsToMany(Materia::class,'materia_x_grupos', 'id_grupo', 'id_materia')
                    ->withPivot('id_trabajador')
                    ->withTimestamps();
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class,'id_inscripcion');
    }

    public function planeaciones()
    {
        return $this->hasMany(Planeacion::class,'id_planeacion');
    }
}
