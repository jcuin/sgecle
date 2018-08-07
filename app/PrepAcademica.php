<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PrepAcademica extends Model
{
    //
    protected $table = 'cat_prep_academicas';
    protected $primaryKey = 'id_prep_academica';

    use Sortable;

	public $sortable = ['id_prep_academica', 'grado_academico'];

    protected $fillable = [
        'grado_academico'
    ];

    public function trabajador()
    {
        return $this->hasMany(Trabajador::class,'id_trabajador');
    }
}
