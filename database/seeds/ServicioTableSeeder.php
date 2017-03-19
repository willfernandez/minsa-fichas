<?php

namespace database\seeds;
use App\Entities\Servicio;

class ServicioTableSeeder extends BaseSeeder

{
    public function getModel()
    {
        return new Servicio();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'nom_servicio' => $faker->firstNameMale(),
        ];
    }
}
