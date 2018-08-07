<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pagina extends Model
{
    //
  	protected $table = 'pagina';

  	use Sortable;

	public $sortable = ['desde', 'hasta', 'descripcion'];

    protected $fillable = [
        'banner_principal_texto'
    ];

    public function convenios()
    {
        return $this->hasMany(Pagina_convenios::class,'id_pagina');
    }

    public function horarios()
    {
        return $this->hasMany(Pagina_horarios::class,'id_pagina');
    }

    public function instalaciones()
    {
        return $this->hasMany(Pagina_instalaciones::class,'id_pagina');
    }

    public function oferta()
    {
        return $this->hasMany(Pagina_oferta::class,'id_pagina');
    }

    public function talleres()
    {
        return $this->hasMany(Pagina_talleres::class,'id_pagina');
    }
}
