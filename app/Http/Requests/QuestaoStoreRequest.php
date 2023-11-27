<?php

namespace App\Http\Requests;

use App\Perfil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuestaoStoreRequest extends FormRequest
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
            'id_disciplina' => ['required'],
            'id_topico' => ['required'],
            'codigo_questao' => ['required', 'unique:questaos,codigo_questao'],
            'titulo_questao' => ['required'],
            'resposta' => ['required'],
            'descricao' => ['required']
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
            'codigo_questao.required' => 'Código da questão obrigatório',
            'codigo_questao.unique' => 'Código da questão já está vinculado a um existente',
            'id_topico.required' => 'Tópico da questão obrigatório',
            'titulo_questao.required' => 'Título obrigatório',
            'resposta.required' => 'Resposta obrigatório',
            'id_disciplina.required' => 'Disciplina obrigatório',
            'descricao.required' => 'Descrição obrigatório',
        ];
    }
}
