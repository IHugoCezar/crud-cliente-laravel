<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;

/**
 * Controlador responsável por gerenciar operações relacionadas a clientes.
 * 
 * Este controller lida com todas as operações CRUD (Create, Read, Update, Delete)
 * para a entidade Cliente, incluindo exibição, criação, edição e remoção de registros.
 */
class ClienteController extends Controller
{
    /**
     * Exibe uma listagem de todos os clientes ordenados por ID decrescente.
     * 
     * @return \Illuminate\View\View Retorna a view 'clientes.index' com a lista de clientes
     */
    public function index() 
    {
        $clientes = Cliente::orderByDesc('id')->get();
        return view('clientes.index', ['clientes' => $clientes]); 
    }

    /**
     * Exibe os detalhes de um cliente específico.
     * 
     * @param Cliente $cliente O modelo Cliente a ser exibido (via route model binding)
     * @return \Illuminate\View\View Retorna a view 'clientes.show' com os dados do cliente
     */
    public function show(Cliente $cliente) 
    {
        return view('clientes.show',  compact('cliente'));
    }

    /**
     * Exibe o formulário para criação de um novo cliente.
     * 
     * @return \Illuminate\View\View Retorna a view 'clientes.create' com o formulário
     */
    public function create()
    { 
        return view('clientes.create');
    }

    /**
     * Armazena um novo cliente no banco de dados.
     * 
     * @param ClienteRequest $request Request validada com os dados do formulário
     * @return \Illuminate\Http\RedirectResponse Redireciona para a lista de clientes com mensagem de sucesso
     */
    public function store(ClienteRequest $request)
    {
        $validated = $request->validated();

        Cliente::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'dt_nascimento' => $validated['dt_nascimento'] ?? null,
            'cpf_cnpj' => $validated['cpf_cnpj'],
            'nome_social' => $validated['nome_social'] ?? null,
            'foto' => $this->handleFotoUpload($request)
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    } 

    /**
     * Exibe o formulário para edição de um cliente existente.
     * 
     * @param Cliente $cliente O modelo Cliente a ser editado (via route model binding)
     * @return \Illuminate\View\View Retorna a view 'clientes.edit' com os dados do cliente
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza os dados de um cliente existente no banco de dados.
     * 
     * @param ClienteRequest $request Request validada com os dados do formulário
     * @param Cliente $cliente O modelo Cliente a ser atualizado
     * @return \Illuminate\Http\RedirectResponse Redireciona para a página do cliente com mensagem de sucesso
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $validated = $request->validated();

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'dt_nascimento' => $validated['dt_nascimento'] ?? null,
            'cpf_cnpj' => $validated['cpf_cnpj'],
            'nome_social' => $validated['nome_social'] ?? null
        ];

        if ($request->hasFile('foto')) {
            $updateData['foto'] = $this->handleFotoUpload($request);
        }

        $cliente->update($updateData);

        return redirect()->route('clientes.show', $cliente)
                         ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove um cliente do banco de dados.
     * 
     * @param Cliente $cliente O modelo Cliente a ser removido
     * @return \Illuminate\Http\RedirectResponse Redireciona para a lista de clientes com mensagem de sucesso
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }

    /**
     * Manipula o upload da foto do cliente.
     * 
     * @param \Illuminate\Http\Request $request Request contendo o arquivo de foto
     * @return string|null Retorna o caminho relativo da foto ou null se não houver upload
     */
    private function handleFotoUpload($request): ?string
    {
        if (!$request->hasFile('foto')) {
            return null;
        }

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
            
        $path = $file->storeAs('clientes', $fileName, 'public');
        
        return 'storage/clientes/' . $fileName;
    }
}