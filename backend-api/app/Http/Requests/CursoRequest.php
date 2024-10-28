<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            'nome_curso' => 'required',
            'descricao_curso' => 'required',
            'modcurso_id' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagem é opcional
        ];
    }

    public function messages()
    {
        return [
            'nome_curso.required' => 'O campo nome do curso é obrigatório',
            'descricao_curso.required' => 'O campo descrição do curso é obrigatório',
            'modcurso_id.required' => 'O campo modalidade do curso é obrigatório',
        ];
    }
}
