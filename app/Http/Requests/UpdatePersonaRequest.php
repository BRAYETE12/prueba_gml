<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonaRequest extends FormRequest
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
            'id' => 'required|numeric|unique:personas,id,'. $this->id,
            'cedula' => 'required|numeric|unique:personas,cedula,'. $this->id,
            'email' => 'required|email|max:150|unique:personas,email,'. $this->id,
            'categoria_id' => 'required|numeric|exists:categorias,id',
            'nombres' => 'required|regex:/^[a-zA-Z\s]+$/|min:5|max:100',
            'apellidos' => 'required|regex:/^[a-zA-Z\s]+$/|min:5|max:100',
            'pais' => 'required',
            'direccion' => 'required|max:180',
            'celular' => 'required|numeric|digits:10',
        ];
    }
}
