<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Entity
{
    protected $fillable= ['paciente_id','servicio_id','turno','diagnostico', 'tipo_incidente_id', 'tipo_evento_id', 'categoria_adverso_id', 'problema_id', 'descrip_suceso','personal_id'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::getClass());
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::getClass());
    }

    public function tipoIncidente()
    {
        return $this->belongsTo(TipoIncidente::getClass());
    }

    public function tipoEvento()
    {
        return $this->belongsTo(TipoEvento::getClass());
    }

    public function categoriaAdverso()
    {
        return $this->belongsTo(CategoriaAdverso::getClass());
    }

    public function problema()
    {
        return $this->belongsTo(Problema::getClass());
    }

    public function personal()
    {
        return $this->belongsTo(Personal::getClass());
    }
}
