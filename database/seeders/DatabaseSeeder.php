<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Cliente::factory(50)->create();

        Cliente::factory()->create([
            'name' => 'Cliente de Teste',
            'email' => 'teste@exemplo.com',
            'cpf_cnpj' => '12345678901', 
            'dt_nascimento' => '1985-05-15',
            'nome_social' => 'Nome Social de Teste'
        ]);
    }
}