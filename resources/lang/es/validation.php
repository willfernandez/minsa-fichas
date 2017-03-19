<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */


    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'required'             => 'Ingrese el campo :attribute.',
    'same'                 => 'The :attribute and :other must match.',
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'fecha_inicio' => [
            'required' => 'Es importante que ingreses la fecha de inicio',
        ],
        'fecha_fin' => [
            'required' => 'Es importante que ingreses la fecha final',
            'date' => 'Debe ingresar una fecha con formato Mes-Dia-Año',
        ],
        'tipo_incidente_id' => [
            'required' => 'Seleccione el Tipo de Incidiente'
        ],
        'servicio_id' => [
            'required' => 'Seleccione el Tipo de Servicio'
        ],
        'turno' => [
            'required' => 'Seleccione el Turno'
        ],
        'diagnostico' => [
            'required' => 'Escriba un Diagnóstico'
        ],
        'tipo_evento_id' => [
            'required' => 'Seleccione el Tipo de Evento'
        ],
        'categoria_adverso_id' => [
            'required' => 'Seleccione la Categoria'
        ],
        'problema_id' => [
            'required' => 'Seleccione el Tipo de Problema'
        ],
        'descrip_suceso' => [
            'required' => 'Escriba una Descripción'
        ],
        'personal_id' => [
            'required' => 'Seleccione el Personal'
        ],
        'nom_paciente'=> [
            'required' => 'Ingrese nombre del paciente'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'ape_paciente' => 'Apellidos',
        'edad_paciente' => 'Edad del Paciente',
        'sexo' => 'Género'
    ],

];
