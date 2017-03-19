<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFichaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "paciente_id" => "Required",
            "servicio_id" => "Required",
            "turno" => "Required",
            "diagnostico" => "Required",
            "tipo_incidente_id" => "Required",
            "tipo_evento_id" => "Required",
            "categoria_adverso_id" => "Required",
            "problema_id" => "Required",
            "descrip_suceso" => "Required",
            "personal_id" => "Required"
        ];
    }
}
