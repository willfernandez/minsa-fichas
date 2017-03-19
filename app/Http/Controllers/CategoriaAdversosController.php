<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriaAdversoRespository;
use Illuminate\Http\Request;

class CategoriaAdversosController extends Controller
{
    private $categoriaAdversoRepo;

    public function __construct(CategoriaAdversoRespository $categoriaAdversoRespository)
    {
        $this->middleware('auth');
        $this->categoriaAdversoRepo = $categoriaAdversoRespository;
    }
    public function index()
    {
        $categorias =  $this->categoriaAdversoRepo->getAllCat();
        return $categorias->map(function ($categoria) {
            return [
                'text'              => $categoria->nom_categoria,
                'value'             => $categoria->id,
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
