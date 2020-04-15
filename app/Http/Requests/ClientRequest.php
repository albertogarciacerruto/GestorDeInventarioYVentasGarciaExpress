<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'lastname'=> 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/u',
            'address' => 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.-]+$/',
            'identification_number' => ['required', 'numeric', 'min:1000000', 'max:999999999999', 'unique:clients'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo es obligatorio.',
            'name.regex' =>'Solo acepta letras y espacios.',
            'address.regex' => 'Puede utilizar solo letras, numeros, guiones, puntos y espacios.',
            'identification_number.min' => 'Debe ingresar un numero de identificaion valido.',
            'identification_number.max' => 'Debe ingresar un numero de identificaion valido.',
            'email' => 'Debe ingresar un correo valido',
          ];
    }
}
