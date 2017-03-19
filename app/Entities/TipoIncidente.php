<?php

namespace App\Entities;


class TipoIncidente extends Entity
{
    protected $fillable= ['nom_incidente', 'descripcion'];

    public function fichas()
    {
        return $this->hasMany(Ficha::getClass());
    }
}
