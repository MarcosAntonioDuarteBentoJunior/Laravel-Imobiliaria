<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealtyRequest extends FormRequest
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
            'name' => 'required',
            'rooms' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'parking' => 'required|numeric',
            'value' => 'required',
            'area' => 'required',
            'description' => 'required',
            'usage_id' => 'required',
            'category_id' => 'required',
            'photos.*' => 'required',
            'street' => 'required',
            'district' => 'required',
            'city' => 'required'
        ];
    }

    public function messages()
    {
		return [
			'required' => 'Este campo é obrigatório!',
            'numeric' => 'Este campo deve ser numérico!',
            'image' => 'Arquivo não é uma imagem válida!'
		];
    }
}
