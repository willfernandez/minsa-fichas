<?php

namespace App\Http\Controllers;

use App\Repositories\TipoEventoRepository;
use App\Repositories\TipoIncidenteRepository;
use Illuminate\Http\Request;

class TipoEventosController extends Controller
{

    private $tipoEventosRepo;

    public function __construct(TipoEventoRepository $tipoEventoRepository)
    {
        $this->middleware('auth');
        $this->tipoEventosRepo = $tipoEventoRepository;
    }

    public function index()
    {
        $eventos = $this->tipoEventosRepo->getAll();
        return $eventos->map(function ($evento) {
            return [
                'text'              => $evento->nom_tip_evento,
                'value'             => $evento->id,
                'descripcion'       => $evento->descripcion
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
