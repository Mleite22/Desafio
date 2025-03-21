<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Manipula as falhas de validaçõe e retorna uma resposta JSON
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

     protected function failedValidation(Validator $validator)
     {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ],422));
     }


    /**
     * Retorna as regras de validação para os dados do usuário
     * $this->user() ? $this->user()->id : null;: Este código verifica se há um usuário
     * autenticado (o que ocorre em atualizações) e obtém seu ID. Caso contrário, 
     * retorna null, o que serve para a criação de um novo usuário
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //Recupera o id do usuario na edição
        $userId = $this->user() ? $this->user()->id : null;
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($userId ? ',' . $userId : ''),
            'password' => 'sometimes|nullable|min:6',
        ];
    }

    /**
     * Retorna as mensagens de erro personalizadas para as validações
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'O campo e-mail deve ser um e-mail válido',
            'email.unique' => 'O e-mail já está em uso',
            'password.required' => 'O campo senha é obrigatório',
            'password.min' => 'A senha deve ter no mínimo :min caracteres',
        
        ];
    }
}
