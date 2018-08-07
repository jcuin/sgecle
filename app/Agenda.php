<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Agenda extends Model
{
    //
    protected $table = 'agenda';
    protected $primaryKey = 'id_agenda';

    use Sortable;

    public $sortable = ['evento', 'descripcion', 'fecha_evento', 'hora_inicio', 'hora_fin'];

    protected $fillable = [
            'evento',
            'descripcion',
            'fecha_evento',
            'hora_inicio',
            'hora_fin'
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class,'id_periodo');
    }

    public function escolaridad()
    {
        return $this->belongsTo(Escolaridad::class,'id_escolaridad');
    }
}