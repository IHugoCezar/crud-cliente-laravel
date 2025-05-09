<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa um Cliente no sistema.
 * 
 * Esta classe gerencia os dados dos clientes, incluindo:
 * - Cadastro básico (nome, e-mail)
 * - Documentos (CPF/CNPJ)
 * - Dados complementares (data de nascimento, nome social, foto)
 */
class Cliente extends Model
{
    use HasFactory;

    /**
     * Nome da tabela no banco de dados associada ao modelo.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
     * Atributos que podem ser atribuídos em massa (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'dt_nascimento',
        'cpf_cnpj',
        'nome_social',
        'foto'
    ];

    /**
     * Define os tipos de conversão para os atributos do modelo.
     * 
     * - Converte 'dt_nascimento' para o tipo date
     * - Garante que 'cpf_cnpj' seja tratado como string
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'dt_nascimento' => 'date',
            'cpf_cnpj' => 'string',
        ];
    }

    /**
     * Mutator para formatar o CPF/CNPJ antes de salvar no banco de dados.
     * 
     * Remove todos os caracteres não numéricos do valor informado
     *
     * @param  string  $value Valor original do CPF/CNPJ
     * @return void
     */
    public function setCpfCnpjAttribute($value)
    {
        $this->attributes['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * Accessor para formatar o CPF/CNPJ para exibição.
     * 
     * Aplica a formatação adequada conforme o tamanho do documento:
     * - CPF (11 dígitos): 000.000.000-00
     * - CNPJ (14 dígitos): 00.000.000/0000-00
     *
     * @return string|null Retorna o documento formatado ou o valor original se não for CPF/CNPJ válido
     */
    public function getCpfCnpjFormatadoAttribute(): ?string
    {
        $valor = $this->cpf_cnpj;
        
        if (strlen($valor) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $valor);
        } elseif (strlen($valor) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $valor);
        }
        
        return $valor;
    }    
}