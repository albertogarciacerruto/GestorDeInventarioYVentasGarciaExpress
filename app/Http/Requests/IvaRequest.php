<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IvaRequest extends FormRequest
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
            'value' => 'required|regex:/^\d+(\.\d{1,2})?$/',
          ];
        
    }
    public function messages()
    {
        return [
            'required' => 'El campo es obligatorio.',
            'amount.regex' => 'Introduzca solo valores numericos enteros o decimales con punto (.).',
          ];
    }
}
