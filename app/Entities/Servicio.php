<?php

namespace App\Entities;


class Servicio extends Entity
{
    protected $fillable= ['nom_servicio'];

    public function fichas()
    {
        return $this->hasMany(Ficha::getClass());
    }
}
