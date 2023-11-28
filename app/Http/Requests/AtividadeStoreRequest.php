<?php

namespace App\Http\Requests;

use App\Perfil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AtividadeStoreRequest extends FormRequest
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
            'id_disciplina' => ['required', 'integer'],
            'descricao_atividade' => ['required'],
            'titulo_atividade' => ['required'],
            'id_questao' => ['required']
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
            'id_disciplina.required' => 'Disciplina obrigatório',
            'descricao_atividade.required' => 'Descrição da atividade obrigatório',
            'titulo_atividade.required' => 'Título obrigatório',
            'id_questao.required' => 'Questão obrigatório',
        ];
    }

}
