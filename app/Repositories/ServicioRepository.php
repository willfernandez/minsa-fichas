<?php
/**
 * Created by PhpStorm.
 * User: WillFernadez
 * Date: 1/10/17
 * Time: 8:00 PM
 */

namespace App\Repositories;

use App\Entities\Servicio;

class ServicioRepository extends  BaseRepository
{

    public function getModel()
    {
        return new Servicio();
    }
}