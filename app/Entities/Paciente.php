<?php

namespace App\Entities;


class Paciente extends Entity
{

    protected $fillable= ['num_ficha','nom_paciente', 'ape_paciente', 'edad_paciente', 'sexo'];

    public function fichas()
    {
        return $this->HasMany(Ficha::getClass());
    }
}
