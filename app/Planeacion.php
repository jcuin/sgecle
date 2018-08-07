<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Planeacion extends Model
{
    //
    protected $table = 'planeaciones';
    protected $primaryKey = 'id_planeacion';

    use Sortable;

	public $sortable = ['id_planeacion', 'id_trabajador'];

    protected $fillable = [
            
    ];

    public function propietario()
    {
        return $this->belongsTo(Trabajador::class,'id_trabajador');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'id_grupo');
    }

    public function anexos()
    {
        return $this->hasMany(Anexo::class,'id_planeacion');
    }

    public function propuestas()
    {
        return $this->hasMany(Propuesta::class,'id_planeacion');
    }
}
