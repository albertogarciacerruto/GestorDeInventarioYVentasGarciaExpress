<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
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
            'bank' => '',
            'confirmation' => 'nullable|alpha_num',
            'payment_id' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'suggestion' => 'nullable|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.-]+$/',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ];
    }

    public function messages()
  {
      return [
        'required' => 'El campo es obligatorio.',
        'confirmation.alpha_num' =>'Solo acepta secuencia de letras y numeros. ',
        'suggestion.regex' => 'Solo acepta letras, numeros, guiones, puntos y espacios.',
        'amount.regex' => 'Introduzca solo valores numericos enteros o decimales con punto (.).',
        'image.mimes' => 'Formato de imagen debe ser JPEG, JPG, PNG o GIF', 
      ];
  }
}
