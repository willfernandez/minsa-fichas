<?php

namespace App\Http\Controllers;

use App\Repositories\TipoIncidenteRepository;
use Illuminate\Http\Request;

class TipoIncidentesController extends Controller
{
    private $tipoIncidenteRepo;

    public function __construct(TipoIncidenteRepository $tipoIncidenteRepository)
    {
        $this->middleware('auth');
        $this->tipoIncidenteRepo = $tipoIncidenteRepository;
    }

    function index()
    {
        $incidentes = $this->tipoIncidenteRepo->getAll();
        return $incidentes->map(function ($incidente) {
            return [
                'text'              => $incidente->nom_incidente,
                'value'             => $incidente->id,
                'descripcion'       => $incidente->descripcion
            ];
        })->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
