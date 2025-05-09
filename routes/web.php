<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

/**
 * Rotas para o gerenciamento de clientes.
 * 
 * Define todas as rotas CRUD para o recurso de clientes, mapeando cada ação
 * para os métodos correspondentes no ClienteController.
 * 
 * As rotas seguem a convenção RESTful e incluem:
 * - Listagem de clientes
 * - Criação de novo cliente
 * - Armazenamento de cliente no banco
 * - Visualização de cliente específico
 * - Edição de cliente
 * - Atualização de cliente
 * - Exclusão de cliente
 */
Route::resource('', ClienteController::class)->names([
    'index' => 'clientes.index',       // Rota para listagem de clientes
    'create' => 'clientes.create',     // Rota para formulário de criação
    'store' => 'clientes.store',       // Rota para armazenar novo cliente
    'show' => 'clientes.show',         // Rota para exibir um cliente específico
    'edit' => 'clientes.edit',         // Rota para formulário de edição
    'update' => 'clientes.update',     // Rota para atualizar um cliente
    'destroy' => 'clientes.destroy'    // Rota para excluir um cliente
])->parameters([
    '' => 'cliente'  // Define o nome do parâmetro de rota como 'cliente'
]);