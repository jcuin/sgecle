<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Rol extends Model
{
    //
	protected $table = 'cat_roles';
    protected $primaryKey = 'id_rol';

    use Sortable;

	public $sortable = ['id_rol', 'rol_key', 'rol'];

    protected $fillable = [
            'rol',
            'descripcion'
    ];

    public function users()
    {
        return $this->belongsToMany(Rol::class,'roles_x_users', 'id_user', 'id_rol')->withTimestamps();
    }
}
