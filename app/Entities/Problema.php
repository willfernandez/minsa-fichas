<?php

namespace App\Entities;


class Problema extends Entity
{
    protected $fillable= ['nom_problema'];

    public function categoriaAdverso()
    {
        return $this->belongsTo(CategoriaAdverso::getClass());
    }
}
