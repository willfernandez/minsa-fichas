<?php

namespace App\Http\Controllers;

use App\Repositories\PacienteRepository;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
   private $pacienteRepository;

    public function __construct(PacienteRepository $pacienteRepository)
    {
        $this->middleware('auth');
        $this->pacienteRepository = $pacienteRepository;
    }
    public function index()
    {
        return view('pacientes/list');
    }

    public function listar()
    {
         return $this->pacienteRepository->getAll();
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
        $this->validate($request,[
            'num_ficha' => 'required',
           'nom_paciente' => 'required',
            'ape_paciente' => 'required',
            'edad_paciente' => 'required|numeric',
            'sexo' => 'required'
        ]);
        $create = $this->pacienteRepository->store($request);

        return $create;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  $this->pacienteRepository->findOrFail($id);
    }

    public function findPaciente(Request $req)
    {

        // if the user entered the keyword
        if ($req->has('q')){
            // Using the Laravel Scout syntax to search the products table.
            $paciente = $this->pacienteRepository->find($req->get('q'));
            // If there are results return them, if none, return the error message.
            return $paciente;
        }
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
        $paciente = $this->pacienteRepository->findOrFail($id);
        $paciente->delete();
    }
}
