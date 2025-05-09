<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration para criação da tabela de clientes.
 * 
 * Esta migration define a estrutura da tabela 'clientes' no banco de dados,
 * incluindo todos os campos necessários para o cadastro completo de clientes,
 * com os respectivos tipos de dados, constraints e índices.
 */
return new class extends Migration
{
    /**
     * Executa as migrações (criação da tabela).
     * 
     * Cria a tabela 'clientes' com os seguintes campos:
     * - ID primário automático
     * - Nome completo (obrigatório, 100 caracteres)
     * - E-mail (obrigatório, único, 100 caracteres)
     * - Data de nascimento (opcional)
     * - CPF/CNPJ (obrigatório, único, 14 caracteres)
     * - Nome social (opcional, 100 caracteres)
     * - Foto (opcional - armazena o caminho do arquivo)
     * - Timestamps de criação e atualização
     * 
     * Adiciona índices para otimização de consultas nos campos:
     * - name (nome do cliente)
     * - dt_nascimento (data de nascimento)
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->date('dt_nascimento')->nullable();
            $table->string('cpf_cnpj', 14)->unique(); // CPF (11) ou CNPJ (14) dígitos
            $table->string('nome_social', 100)->nullable();
            $table->string('foto')->nullable()->comment('Caminho para a foto do cliente');
            $table->timestamps();
            
            // Índices adicionais para melhor performance
            $table->index('name');
            $table->index('dt_nascimento');
        });
    }

    /**
     * Reverte as migrações (exclusão da tabela).
     * 
     * Remove completamente a tabela 'clientes' do banco de dados,
     * incluindo todos os seus dados, índices e constraints.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};