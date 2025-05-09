<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Gera um CPF ou CNPJ aleatório (apenas números)
        $cpf_cnpj = rand(0, 1) 
            ? $this->gerarCpfValido() 
            : $this->gerarCnpjValido();

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'dt_nascimento' => $this->faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'cpf_cnpj' => $cpf_cnpj,
            'nome_social' => rand(0, 1) ? $this->faker->name() : null,
            'foto' => rand(0, 1) ? 'clientes/' . $this->faker->image('public/storage/clientes', 400, 400, null, false) : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Gera um CPF válido (apenas números)
     */
    private function gerarCpfValido(): string
    {
        $cpf = '';
        for ($i = 0; $i < 9; $i++) {
            $cpf .= rand(0, 9);
        }
        
        // Cálculo dos dígitos verificadores
        $cpf .= $this->calculaDigitoCpf($cpf);
        $cpf .= $this->calculaDigitoCpf($cpf);
        
        return $cpf;
    }

    /**
     * Gera um CNPJ válido (apenas números)
     */
    private function gerarCnpjValido(): string
    {
        $cnpj = '';
        for ($i = 0; $i < 12; $i++) {
            $cnpj .= rand(0, 9);
        }
        
        // Cálculo dos dígitos verificadores
        $cnpj .= $this->calculaDigitoCnpj($cnpj);
        $cnpj .= $this->calculaDigitoCnpj($cnpj);
        
        return $cnpj;
    }

    /**
     * Calcula o dígito verificador para CPF
     */
    private function calculaDigitoCpf($base): int
    {
        $tamanho = strlen($base);
        $multiplicador = $tamanho + 1;
        $soma = 0;

        for ($i = 0; $i < $tamanho; $i++) {
            $soma += $base[$i] * $multiplicador;
            $multiplicador--;
        }

        $resto = $soma % 11;
        return $resto < 2 ? 0 : 11 - $resto;
    }

    /**
     * Calcula o dígito verificador para CNPJ
     */
    private function calculaDigitoCnpj($base): int
    {
        $tamanho = strlen($base);
        $multiplicadores = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;

        for ($i = 0; $i < $tamanho; $i++) {
            $soma += $base[$i] * $multiplicadores[$i + (13 - $tamanho)];
        }

        $resto = $soma % 11;
        return $resto < 2 ? 0 : 11 - $resto;
    }
}