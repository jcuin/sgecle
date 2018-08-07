<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagina_talleres extends Model
{
    //
    protected $table = 'pagina_talleres';

    protected $fillable = [
        'talleres_imagen',
        'talleres_titulo',
        'talleres_texto'
    ];
}
