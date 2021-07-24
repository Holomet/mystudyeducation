<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCollageRequest extends FormRequest
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
            'name' => 'required|max:100',
            'address' => 'required|max:250',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rollup_banner' => 'required|max:2048',
            'stall_video' => 'required|mimes:mp4,mov,ogg,qt | max:50000',
            'about' => 'required|max:250',
            'prospectus' => 'required|mimes:pdf|max:10000',
            'status' => 'required|integer|max:1',
            'zones' => 'required'
        ];
    }
}
