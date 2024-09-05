<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    public function rules(): array
    {
        return[
            'name' => 'required|string|min:1|max:255',
            'email' => [
                'required',
                'email',
                //'unique:users,email', configurar de forma manual, mas da pra utilizar rule do laravel
                Rule::unique('users', 'email')->ignore($this->user, 'id') //user é o nome da variavel passado nas rotas -- ignore compara o id do usuario com o email do usuario, se for email de outra pessoa ele vai dar erro de email ja usado
            ],
            'password' => [
                'required',
                'min: 6',
                'max: 15',
            ]
        ];
    }
}
