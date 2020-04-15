<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderUpdateRequest extends FormRequest
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
            'name'=> 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.-]+$/',
            'rif' => 'required|regex:/([jJ]{1})[0-9]/|min:7|max:13',
            'address' => 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.-]+$/',
            'email' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{10}/',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo es obligatorio.',
            'name.regex' =>'Puede utilizar solo letras, numeros, guiones, puntos y espacios.',
            'unique' => 'El valor del campo esta registrado.',
            'rif.min' => 'Solo "J" o "j" seguido con secuencia numerica de entre 8 y 12 numeros. Ejemplo: J123123123123',
            'rif.max' => 'Solo "J" o "j" seguido con secuencia numerica de entre 8 y 12 numeros. Ejemplo: J123123123123',
            'phone.regex' => 'Debe ingresar valor similar a: "04241234567".',
            'address.regex' => 'Puede utilizar solo letras, numeros, guiones, puntos y espacios.',
          ];
    }
}
