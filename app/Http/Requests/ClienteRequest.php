<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Classe de validação para operações relacionadas a clientes.
 * 
 * Esta request define as regras de validação para criação e atualização de clientes,
 * incluindo validações de campos como nome, e-mail, CPF/CNPJ e foto.
 */
class ClienteRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     * 
     * @return bool Retorna true para indicar que a requisição é permitida
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtém as regras de validação que se aplicam à requisição.
     * 
     * As regras incluem:
     * - Validação de campos obrigatórios
     * - Formato de e-mail
     * - Validação de CPF/CNPJ (11 ou 14 dígitos)
     * - Validação de arquivo de imagem para foto
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('clientes')->ignore($this->cliente),
            ],
            'dt_nascimento' => 'nullable|date',
            'cpf_cnpj' => [
                'required',
                'string',
                'max:14',
                Rule::unique('clientes')->ignore($this->cliente),
                function ($attribute, $value, $fail) {
                    $cleanedValue = preg_replace('/[^0-9]/', '', $value);
                    $length = strlen($cleanedValue);
                    
                    if (!($length === 11 || $length === 14)) {
                        $fail('O campo CPF/CNPJ deve ter 11 dígitos (CPF) ou 14 dígitos (CNPJ).');
                    }
                },
            ],
            'nome_social' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($this->isMethod('post')) {
            $rules['foto'] = 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    /**
     * Obtém mensagens personalizadas para erros de validação.
     * 
     * @return array<string, string> Retorna um array com mensagens customizadas para cada regra de validação
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'cpf_cnpj.required' => 'O campo CPF/CNPJ é obrigatório.',
            'cpf_cnpj.unique' => 'Este CPF/CNPJ já está cadastrado.',
            'foto.image' => 'O arquivo deve ser uma imagem válida.',
            'foto.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'foto.max' => 'A imagem não pode ser maior que 2MB.',
        ];
    }

    /**
     * Prepara os dados para validação, limpando o campo CPF/CNPJ antes de validar.
     * 
     * Remove caracteres não numéricos do CPF/CNPJ antes de aplicar as regras de validação
     */
    protected function prepareForValidation()
    {
        if ($this->has('cpf_cnpj')) {
            $this->merge([
                'cpf_cnpj' => preg_replace('/[^0-9]/', '', $this->cpf_cnpj),
            ]);
        }
    }
}