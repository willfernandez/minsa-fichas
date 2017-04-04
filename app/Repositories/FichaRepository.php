<?php
namespace App\Repositories;
use App\Entities\Ficha;

class FichaRepository extends BaseRepository
{

    public function getModel()
    {
        return new Ficha();
    }

    public function store($request)
    {
        return $this->getModel()->create($request);
    }

    public function r_num_incidentes_servicio($servicio_id, $fecha, $tipo_incidente)
    {
        return $this->getModel()->where('fichas.tipo_incidente_id', '=', $tipo_incidente)
                                ->where('fichas.servicio_id', '=', $servicio_id)
                                ->whereBetween('fichas.fecha_ficha', $fecha)
                                ->count('fichas.id');

    }

    public function r_num_incidentes($fecha, $tipo_incidente)
    {
       // dd($fecha);
        return $this->getModel()->where('fichas.tipo_incidente_id', '=', $tipo_incidente)
                                ->whereBetween('fichas.fecha_ficha', $fecha)
                                ->count('fichas.id');

    }

    public function r_num_problemas_categoria($problema_id, $fecha_inicio, $fecha_fin, $tipo_incidente_id)
    {
        $fecha = [$fecha_inicio, $fecha_fin];
        return $this->getModel()->where('fichas.problema_id', '=', $problema_id)
            ->where('fichas.tipo_incidente_id', '=', $tipo_incidente_id)
            ->whereBetween('fichas.fecha_ficha', $fecha)
            ->count('fichas.id');
    }

    public function r_num_total_personals($fecha_inicio, $fecha_fin)
    {
        $fecha = [$fecha_inicio, $fecha_fin];
        return $this->getModel()->whereBetween('fichas.fecha_ficha', $fecha)
                                ->count('fichas.id');

    }
    public function r_num_personals($personal_id, $fecha_inicio, $fecha_fin)
    {
        $fecha = [$fecha_inicio, $fecha_fin];
        return $this->getModel()->where('fichas.personal_id', '=', $personal_id)
                                ->whereBetween('fichas.fecha_ficha', $fecha)
                                ->count('fichas.id');
    }

}