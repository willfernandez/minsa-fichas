<?php

namespace App\Entities;


class TipoEvento extends Entity
{
    protected $fillable= ['nom_tip_evento', 'descripcion'];

    public function fichas()
    {
        return $this->hasMany(Ficha::getClass());
    }

}
