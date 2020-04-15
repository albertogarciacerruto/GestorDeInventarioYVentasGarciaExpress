<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        return [
            'name' => 'required|unique:locations|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
            'store' => 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.-]+$/',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
            'store' => 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.-]+$/',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo es obligatorio.',
            'name.regex' =>'Solo acepta letras y espacios.',
            'store.regex' =>'Solo acepta letras y espacios.',
            'unique' => 'El valor del campo esta registrado.',
          ];
    }
}
