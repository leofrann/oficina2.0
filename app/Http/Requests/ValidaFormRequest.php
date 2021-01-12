<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaFormRequest extends FormRequest
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
            'codigo' => 'required|min:3',
            'cliente' => 'required|min:3',
            'data' => 'required',
            'hora' => 'required',
            'vendedor' => 'required|min:3',
            'valor' => 'required',
            'descricao' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return[
            'required' => 'O campo :attribute é Obrigatori!',
            'min' => 'O campo :attribute precisa ter pelo menos 3 carcteres',
        ];
    }
}
