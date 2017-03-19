<?php

use Illuminate\Database\Seeder;

class PersonalTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function getModel()
    {
        return new Personal();
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
