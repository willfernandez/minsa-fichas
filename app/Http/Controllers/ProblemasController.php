<?php

namespace App\Http\Controllers;

use App\Repositories\ProblemaRepository;
use Illuminate\Http\Request;

class ProblemasController extends Controller
{
    private $problemaRepo;

    public function __construct(ProblemaRepository $problemaRepository)
    {
        $this->middleware('auth');
        $this->problemaRepo = $problemaRepository;
    }
    public function index()
    {
        //
    }

    public function findProblema($id_cat)
    {
        $problemas = $this->problemaRepo->findProblema($id_cat);
        return $problemas->map(function ($problema) {
            return [
                'text'              => $problema->nom_problema,
                'value'             => $problema->id,
            ];
        })->toArray();

    }
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
