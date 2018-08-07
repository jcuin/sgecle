<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagina_horarios extends Model
{
    //
    protected $table = 'pagina_horarios';

    protected $fillable = [
        'horario_imagen',
        'horario_titulo_imagen',
        'horario_texto_imagen'
    ];
}
