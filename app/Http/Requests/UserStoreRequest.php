<?php

namespace App\Http\Requests;

use App\Perfil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->id_perfil == Perfil::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'max:200'],
            'email' => ['required', 'max:200'],
            'password' => ['required', 'min:6'],
            'confirmacao' => ['required', 'min:6'],
            'id_perfil' => ['required']
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
            'id_perfil.required' => 'O Perfil é obrigatório.',
        ];
    }

}
