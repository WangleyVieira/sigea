<?php

namespace App\Http\Requests;

use App\Perfil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuestaoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $usuarioAutenticado = Auth::user()->id_perfil;

        if ($usuarioAutenticado == Perfil::ADMIN) {
            return true;
        }

        if ($usuarioAutenticado == Perfil::USUARIO_EXTERNO) {
            return true;
        }
        
        // return Auth::user()->id_perfil == Perfil::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
            'titulo_questao.required' => 'Título obrigatório',
            'resposta.required' => 'Resposta obrigatório',
            'descricao.required' => 'Descrição obrigatório',
        ];
    }

}
