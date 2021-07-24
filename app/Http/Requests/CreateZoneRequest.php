<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateZoneRequest extends FormRequest
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
            'expo_id' => 'required|exists:expos,id',
            'name' => 'required|max:100',
            'country_id' => 'required|exists:countries,id',
            'status' => 'required|integer|max:1'
        ];
    }
}
