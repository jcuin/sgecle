<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagina_instalaciones extends Model
{
    //
    protected $table = 'pagina_instalaciones';

    protected $fillable = [
        'instalaciones_imagen',
        'instalaciones_titulo_imagen',
        'instalaciones_texto_imagen'
    ];
}
