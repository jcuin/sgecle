<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Periodo extends Model
{
    //
    protected $table = 'cat_periodos';
    protected $primaryKey = 'id_periodo';

    use Sortable;

	public $sortable = ['id_periodo', 'periodo'];

    protected $fillable = [
            'periodo',
            'trimestre_prescolar',
            'bimestre_primaria',
            'bimestre_secundaria',
            'inicio',
            'termino'
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class,'id_grupo');
    }

    public function settings()
    {
        return $this->hasMany(Setting::class,'id_periodo');
    }

}
