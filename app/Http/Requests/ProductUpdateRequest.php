<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name'=> 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/u',
            'description' => 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.-]+$/',
            'amount' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo es obligatorio.',
            'name.regex' =>'Solo acepta letras y espacios.',
            'description.regex' => 'Puede utilizar solo letras, numeros, guiones, puntos y espacios.',
            'image.mimes' => 'Formato de imagen debe ser JPEG, JPG, PNG o GIF', 
          ];
    }
}
