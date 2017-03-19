<?php

namespace App\Entities;


class Personal extends Entity
{
    protected $fillable= ['nom_personal', 'tip_personal'];

    public function fichas()
    {
        return $this->hasMany(Ficha::getClass());
    }

}