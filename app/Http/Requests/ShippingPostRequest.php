<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingPostRequest extends FormRequest
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
            'height' => ['required', 'numeric', 'min:1', 'max:200'],
            'width' => ['required', 'numeric', 'min:1', 'max:200'],
            'weight' => ['required', 'numeric', 'min:1', 'max:10'],
            'destination' => ['in:1,2']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre es Obligatorio',

            'height.required' => 'El campo Alto es Obligatorio',
            'height.numeric' => 'El campo Alto debe ser numerico',
            'height.min' => 'El campo Alto debe contar con al menos 1 cm.',
            'height.max' => 'El campo Alto no debe ser mayor a 2 mt o 200 cm.',

            'width.required' => 'El campo Ancho es Obligatorio',
            'width.numeric' => 'El campo Ancho debe ser numerico',
            'width.min' => 'El campo Ancho debe contar con al menos 1 cm.',
            'width.max' => 'El campo Ancho no debe ser mayor a 2 mt o 200 cm.',

            'weight.required' => 'El campo Peso es Obligatorio',
            'weight.numeric' => 'El campo Peso debe ser numerico',
            'weight.min' => 'El campo Peso debe contar con al menos 1 kg.',
            'weight.max' => 'El campo Peso no debe ser mayor a 10 kg.',

            'destination.in' => 'El campo Destnino debe ser seleccionado',
        ];
    }
}
