<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    public function periodo()
    {
        return $this->belongsTo(Periodo::class,'id_periodo');
    }
}

