<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Informe extends Model
{
    //
    protected $table = 'informes';
    protected $primaryKey = 'id';

    use Sortable;

    public $sortable = ['id', 'nombre', 'email', 'telefono', 'asunto', 'mensaje'];

    protected $fillable = [
            'mensaje'
    ];
}
