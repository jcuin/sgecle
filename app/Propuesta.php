<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Propuesta extends Model
{
    //
    protected $table = 'propuestas';
    protected $primaryKey = 'id_propuesta';

    use Sortable;

	public $sortable = ['id_propuesta', 'id_planeacion'];

    protected $fillable = [
            'detalles'
    ];

    public function planeacion()
    {
        return $this->belongsTo(Planeacion::class,'id_planeacion');
    }
}
