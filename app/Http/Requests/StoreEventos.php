<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventos extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:120',
            'descripcion' => 'required|string',
            'disponibles' => 'required|integer',
            'categoria_id' => 'required|integer',
            'dia_id' => 'required|integer',
            'hora_id' => 'required|integer',
            'ponente_id' => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido.',
            'descripcion.required' => 'La descripción es requerida.',
            'disponibles.required' => 'el campo disponibles es requerido',
            'categoria_id.required' => 'El campo categoría es requerida.',
            'dia_id.required' => 'El día es requerido.',
            'hora_id.required' => 'La hora es requerida.',
            'ponente_id.required' => 'El ponente es requerido.',
        ];
    }
}
