<?php
/**
 * Created by PhpStorm.
 * User: WillFernadez
 * Date: 1/13/17
 * Time: 11:09 PM
 */

namespace App\Repositories;


use App\Entities\Problema;

class ProblemaRepository extends BaseRepository
{

    public function getModel()
    {
        return new Problema();
    }

    public function findProblema($id_cat)
    {
       return $this->getModel()->where('categoria_adverso_id', '=', $id_cat)->get();

    }

    public function getProblemasCategoria()
    {
        return $this->getModel()->with('categoriaAdverso')->get();
    }
}