<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Anexo extends Model
{
    //
    protected $table = 'anexos';
    protected $primaryKey = 'id_anexo';

    use Sortable;

	public $sortable = ['id_anexo', 'id_planeacion', 'fecha_entrega'];

    protected $fillable = [
            'fecha_entrega',
            'fecha_de_uso'
    ];

    public function planeacion()
    {
        return $this->belongsTo(Planeacion::class,'id_planeacion');
    }
}
