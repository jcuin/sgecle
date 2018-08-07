<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagina_oferta extends Model
{
    //
    protected $table = 'pagina_oferta';

    protected $fillable = [
        'oferta_imagen',
        'oferta_titulo',
        'oferta_texto'
    ];
}
