<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Parentesco extends Model
{
    //
    protected $table = 'cat_parentescos';
    protected $primaryKey = 'id_parentesco';

    use Sortable;

	public $sortable = ['id_parentesco', 'parentesco'];

    protected $fillable = [
        'parentesco'
    ];

    public function familiarDeTrabajador()
    {
        return $this->hasMany(Familiar_trabajador::class,'id_estado_civil');
    }
}
