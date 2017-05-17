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

    public function update($data, $id)
    {
        $ficha = $this->getModel()->find($id);
        $ficha->servicio_id = $data['servicio_id'];
        $ficha->turno = $data['turno'];
        $ficha->diagnostico = $data['diagnostico'];
        $ficha->tipo_incidente_id = $data['tipo_incidente_id'];
        $ficha->tipo_evento_id = $data['tipo_evento_id'];
        $ficha->categoria_adverso_id = $data['categoria_adverso_id'];
        $ficha->problema_id = $data['problema_id'];
        $ficha->descrip_suceso = $data['descrip_suceso'];
        $ficha->personal_id = $data['personal_id'];
        $ficha->fecha_ficha = $data['fecha_ficha'];

        $ficha->save();
        return $ficha;
    }

    //PACIENTES

    public function verFichas($paciente_id)
    {
        return $this->getModel()->where('fichas.paciente_id', '=', $paciente_id)->with('paciente')->get();
    }

    public function findFicha($id) /*id ficha */
    {
        return $this->getModel()->find($id);
    }

    //REPORTES
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

    public function total_consolidado_incidente($categoria_id,$problema_id, $servicio_id, $tipo_incidente_id)
    {
        return $this->getModel()->where('fichas.categoria_adverso_id',$categoria_id)
                                ->where('fichas.problema_id', $problema_id)
                                ->where('fichas.servicio_id', $servicio_id)
                                ->where('fichas.tipo_incidente_id', $tipo_incidente_id)
                                ->count('fichas.id');
    }

    public function r_num_incidentes_eventos_servicio($mes, $tipo_incidente_id, $servicio_id)
    {
        return $this->getModel()->where('fichas.tipo_incidente_id', $tipo_incidente_id)
                                ->where('fichas.servicio_id', $servicio_id)
                                ->whereMonth('fichas.fecha_ficha', $mes)
                                ->count('fichas.id');
    }

    public function total_num_incidentes_eventos_servicio($tipo_incidente_id, $servicio_id)
    {
        return $this->getModel()->where('fichas.tipo_incidente_id', $tipo_incidente_id)
            ->where('fichas.servicio_id', $servicio_id)
            ->count('fichas.id');
    }

    public function r_num_incidentes_eventos_personal($mes, $tipo_incidente_id, $personal_id)
    {
        return $this->getModel()->where('fichas.tipo_incidente_id', $tipo_incidente_id)
                                ->where('fichas.personal_id', $personal_id)
                                ->whereMonth('fichas.fecha_ficha', $mes)
                                ->count('fichas.id');
    }



    public function total_num_incidentes_eventos_personal($tipo_incidente_id, $personal_id)
    {
        return $this->getModel()->where('fichas.tipo_incidente_id', $tipo_incidente_id)
            ->where('fichas.personal_id', $personal_id)
            ->count('fichas.id');
    }
    public function total_num_incidentes_eventos_personal_mes($mes,$tipo_incidente_id)
    {
        return $this->getModel()->where('fichas.tipo_incidente_id', $tipo_incidente_id)
            ->whereMonth('fichas.fecha_ficha', $mes)
            ->count('fichas.id');
    }
    public function total_num_incidentes_eventos_personal_consolidado($tipo_incidente_id)
    {
        return $this->getModel()->where('fichas.tipo_incidente_id', $tipo_incidente_id)
            ->count('fichas.id');
    }

    public function r_ficha_servicio($servicio_id, $trimestre, $tipo_incidente_id)
    {
        return $this->getModel()->where('fichas.servicio_id', $servicio_id)
                                ->where('fichas.tipo_incidente_id', $tipo_incidente_id)
                                ->whereBetween('fichas.fecha_ficha', $trimestre)
                                ->orderBy('fichas.fecha_ficha', 'asc')
                                ->get();
    }

}