<?php
/**
 * Created by PhpStorm.
 * User: WillFernadez
 * Date: 1/13/17
 * Time: 10:44 PM
 */

namespace App\Repositories;


use App\Entities\CategoriaAdverso;

class CategoriaAdversoRespository extends BaseRepository
{

    public function getModel()
    {
        return new CategoriaAdverso();
    }

    public function getAllCat()
    {
        return $this->getModel()->all(['id', 'nom_categoria']);
    }

    public function getCategoriasProblemas()
    {
        return $this->getModel()->with('problemas')->get();
    }

}