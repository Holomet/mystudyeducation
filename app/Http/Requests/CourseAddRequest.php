<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseAddRequest extends FormRequest
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
            'course_category_id' => 'required|exists:course_category,id',
            'status' => 'required|integer|max:1'
        ];
    }
}
