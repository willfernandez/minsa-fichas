<?php
/**
 * Created by PhpStorm.
 * User: WillFernadez
 * Date: 1/13/17
 * Time: 10:35 PM
 */

namespace App\Repositories;


use App\Entities\TipoEvento;

class TipoEventoRepository extends BaseRepository
{

    public function getModel()
    {
        return new TipoEvento();
    }
}