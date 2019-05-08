<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class VehicleAvailabilityRequest extends FormRequest
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
            'product_id' => 'required',
            'first_name' => 'required|max:150',
            'last_name' => 'required|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'required|numeric',
            'comment' => 'max:500'
        ];
    }
}
