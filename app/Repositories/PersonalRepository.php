<?php
/**
 * Created by PhpStorm.
 * User: WillFernadez
 * Date: 1/10/17
 * Time: 8:01 PM
 */

namespace App\Repositories;


use App\Entities\Personal;

class PersonalRepository extends BaseRepository
{

    public function getModel()
    {
        return new Personal();
    }
}