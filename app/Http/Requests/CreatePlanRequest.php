<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlanRequest extends FormRequest
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
            'amount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'commission' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'tax' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'total' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'item_count' => 'required|integer',
            'payout_amount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'maximum_visits' => 'required|integer',
            'product_images' => 'required|integer',
            'storage' => 'required|integer',
            'count_product_categories' => 'required|integer',
            'status' => 'required|integer|max:1'
        ];
    }
}
