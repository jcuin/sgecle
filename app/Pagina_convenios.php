<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagina_convenios extends Model
{
    //
    protected $table = 'pagina_convenios';

    protected $fillable = [
        'convenio_imagen',
        'convenio_titulo'
    ];
}
