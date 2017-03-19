<?php
/**
 * Created by PhpStorm.
 * User: WillFernadez
 * Date: 1/13/17
 * Time: 10:06 PM
 */

namespace App\Repositories;


use App\Entities\TipoIncidente;

class TipoIncidenteRepository extends BaseRepository
{

    public function getModel()
    {
        return new TipoIncidente();
    }
}