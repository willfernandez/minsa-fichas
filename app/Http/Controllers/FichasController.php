<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFichaRequest;
use App\Repositories\CategoriaAdversoRespository;
use App\Repositories\FichaRepository;
use App\Repositories\PacienteRepository;
use App\Repositories\PersonalRepository;
use App\Repositories\ServicioRepository;
use App\Repositories\TipoEventoRepository;
use App\Repositories\TipoIncidenteRepository;
use Illuminate\Http\Request;

class FichasController extends Controller
{

    private $pacienteRepo;
    private $tipoIncidenteRepo;
    private $tipoEventoRepo;
    private $categoriaAdversoRepo;
    private $fichaRepo;
    private $personalRepo;

    public function __construct(PacienteRepository $pacienteRepository,
                                TipoIncidenteRepository $tipoIncidenteRepository,
                                TipoEventoRepository $tipoEventoRespository,
                                CategoriaAdversoRespository $categoriaAdversoRepository,
                                FichaRepository $fichaRepository,
                                ServicioRepository $servicioRepository,
                                PersonalRepository $personalRepository)
    {
        $this->middleware('auth');
        $this->pacienteRepo = $pacienteRepository;
        $this->tipoIncidenteRepo= $tipoIncidenteRepository;
        $this->tipoEventoRepo = $tipoEventoRespository;
        $this->categoriaAdversoRepo = $categoriaAdversoRepository;
        $this->fichaRepo = $fichaRepository;
        $this->servicioRepo = $servicioRepository;
        $this->personalRepo = $personalRepository;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_paciente)
    {
        $paciente = $this->pacienteRepo->findOrFail($id_paciente);

        $servicios = $this->servicioRepo->getAll();
        $serviciosSelect = $servicios->pluck('nom_servicio', 'id');

        $tipoIncidentes = $this->tipoIncidenteRepo->getAll();
        $tipoIncidenteSelect = $tipoIncidentes->pluck('nom_incidente', 'id');

        $tipoEventos = $this->tipoEventoRepo->getAll();
        $tipoEventosSelect = $tipoEventos->pluck('nom_tip_evento', 'id');

        $categoriaAdversos = $this->categoriaAdversoRepo->getAll();
        $categoriaAdversosSelect = $categoriaAdversos->pluck('nom_categoria', 'id');

	    $personals = $this->personalRepo->getAll();
        $personalsSelect = $personals->pluck('tip_personal', 'id');


        //dd($tipoIncidente);
        return view('fichas/open_ficha', compact('paciente', 'tipoIncidenteSelect', 'tipoIncidentes', 'tipoEventos', 'tipoEventosSelect', 'categoriaAdversos', 'categoriaAdversosSelect', 'serviciosSelect', 'personalsSelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (StoreFichaRequest $request)
    {
        $this->fichaRepo->store($request->all());
        return view('pacientes/list');
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
