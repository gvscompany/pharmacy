<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'poster' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'manufacturer_id' => 'required|not_in:0',
            'purpose_id' => 'required|not_in:0',
            'price' => 'required',
            'available' => 'required|in:yes,no',
            'from' => 'required|regex:/[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/',
            'to' => 'required|regex:/[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/',
            'description' => 'required'
        ];
    }
}
