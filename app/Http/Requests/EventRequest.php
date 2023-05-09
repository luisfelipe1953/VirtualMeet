<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'required|min:20',
            'category_id' => 'required',
            'day_id' => 'required',
            'time_id' => 'required',
            'speaker_id' => 'nullable|exists:speakers,id',
            'available' => 'required|integer|min:1',
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
            'name.required' => 'El nombre es requerido.',
            'description.required' => 'La descripción es requerida.',
            'available.required' => 'el campo disponibles es requerido',
            'category_id.required' => 'El campo categoría es requerida.',
            'day_id.required' => 'El día es requerido.',
            'time_id.required' => 'La hora es requerida.',
            'speaker_id.required' => 'El ponente es requerido.',
        ];
    }
}
