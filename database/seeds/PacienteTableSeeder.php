<?php

use App\Entities\Paciente;

class PacienteTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new Paciente();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'nom_paciente' => $faker->firstNameMale(),
            'ape_paciente' => $faker->lastName(),
            'edad_paciente' => $faker->randomNumber(2),
            'sexo' => $faker->randomElement($array = array ('F','M','c'))
        ];
    }


}
