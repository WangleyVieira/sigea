<?php

namespace App\Http\Requests;

use App\Perfil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DisciplinaStoreRequest extends FormRequest
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
            'title' => 'required|unique:posts|max:255',
            'nome' => ['required', 'unique:disciplinas,nome'],
            'codigo' => ['required'],
            'id_periodo' => ['required']
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
            'nome.required' => 'Nome obrigatório',
            'nome.unique' => 'Existe uma disciplina cadastrado ao informado.',
            'codigo.required' => 'Código obrigatório',
            'id_periodo.required' => 'Período obrigatório',
        ];
    }
}
