<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Escolaridad extends Model
{
    //
	protected $table = 'cat_escolaridads';
    protected $primaryKey = 'id_escolaridad';

    use Sortable;

	public $sortable = ['id_escolaridad', 'escolaridad', 'nomenclatura', 'horario'];

    protected $fillable = [
            'nomenclatura_grupos',
            'horario'
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class,'id_grupo');
    }

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class,'id_trabajador');
    }
}
