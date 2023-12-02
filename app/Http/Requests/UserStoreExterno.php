<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreExterno extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'confirmacao' => ['required', 'min:6'],
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
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'Nome máximo 100 caracteres.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'Minímo 6 caracteres',
            'confirmacao.required' => 'Confirmação é obrigatória',
            'confirmacao.min' => 'Minímo 6 caracteres',
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'E-mail já está vinculado a um existente',
        ];
    }
}
