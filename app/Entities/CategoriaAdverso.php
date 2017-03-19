<?php

namespace App\Entities;


class CategoriaAdverso extends Entity
{
    protected $fillable= ['nom_categoria'];

    public function fichas()
    {
        return $this->hasMany(CategoriaAdverso::getClass());
    }

    public function problemas()
    {
        return $this->hasMany(Problema::getClass());
    }
}
