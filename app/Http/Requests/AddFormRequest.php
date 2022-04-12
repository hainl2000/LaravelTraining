<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AddFormRequest extends FormRequest
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
            //
            'productName' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'productImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'productPrice' => 'required|integer',
            'productQuantity' => 'required|numeric|min: 0',
            'productDescription' => 'required|max:255|regex:/^[a-zA-Z0-9 ]+$/'
        ];
    }

    public function messages()
    {
        return [
            'productName.required' => "Please enter product's name",
            'productImage.required' => 'Please choose image',
            'productPrice.required' => "Please enter product's price",
            'productDescription.required' => "Please enter product's description",
            'productPrice.integer' => "Product's price must only contain numbers",
        ];
    }

}
