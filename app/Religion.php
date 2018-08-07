<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Religion extends Model
{
    //
    protected $table = 'cat_religions';
    protected $primaryKey = 'id_religion';

    use Sortable;

	public $sortable = ['id_religion', 'religion'];

    protected $fillable = [
        'religion'
    ];

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class,'id_trabajador');
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class,'id_alumno');
    }
}
