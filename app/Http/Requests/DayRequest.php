<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DayRequest extends FormRequest
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
            'day_id' => 'integer',
            'category_id' => 'integer'
        ];
    }
}
