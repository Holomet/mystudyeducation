<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCollageCourse extends FormRequest
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
            'id' => 'required|exists:collage_courses,id',
            'course_id' => 'required|exists:courses,id',
            'course_name' => 'required|max:100',
            'broschure' => 'mimes:pdf|max:10000'
        ];
    }
}
