<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Notificacion extends Model
{
    //
    protected $table = 'notificaciones';
    protected $primaryKey = 'id_notificacion';

    use Sortable;

	public $sortable = ['id_notificacion', 'mensaje', 'caducidad'];

    protected $fillable = [
        'mensaje'
    ];

    public function emisor()
    {
        return $this->belongsTo(Trabajador::class,'id_trabajador_emisor');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class,'id_trabajador_destino');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'id_grupo');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class,'id_materia');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class,'id_alumno');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class,'id_rol');
    }
}
