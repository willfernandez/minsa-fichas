<?php

namespace App\Repositories;

use App\Entities\Paciente;

class PacienteRepository extends  BaseRepository
{

    public function getModel()
    {
        return new Paciente();
    }

    public function getAll()
    {
        $pacientes = $this->getModel()->latest()->paginate(5);

        $response = [
            'pagination' => [
                'total' => $pacientes->total(),
                'per_page' => $pacientes->perPage(),
                'current_page' => $pacientes->currentPage(),
                'last_page' => $pacientes->lastPage(),
                'from' => $pacientes->firstItem(),
                'to' => $pacientes->lastItem()
            ],
            'data' => $pacientes
        ];

        return response()->json($response);
    }

    public function store($request)
    {
        return $this->getModel()->create($request->all());
    }

    public function find($query)
    {
        $pacientes = $this->getModel()->where('ape_paciente', 'LIKE', '%'.$query.'%')->paginate(5);
        if($pacientes->total() > 0)
        {
            $response = [
                'pagination' => [
                    'total' => $pacientes->total(),
                    'per_page' => $pacientes->perPage(),
                    'current_page' => $pacientes->currentPage(),
                    'last_page' => $pacientes->lastPage(),
                    'from' => $pacientes->firstItem(),
                    'to' => $pacientes->lastItem()
                ],
                'data' => $pacientes
            ];
        }else{
            $response = [
                'pagination' => [
                    'total' => $pacientes->total(),
                    'per_page' => $pacientes->perPage(),
                    'current_page' => $pacientes->currentPage(),
                    'last_page' => $pacientes->lastPage(),
                    'from' => $pacientes->firstItem(),
                    'to' => $pacientes->lastItem()
                ],
                'error' => 'No se encontraron coincidencias con: '
                ];
        }
        return response()->json($response);
    }
}