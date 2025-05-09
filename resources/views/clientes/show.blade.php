<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes do Cliente | Desafio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="nav-actions">
            <a href="{{ route('clientes.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Voltar para lista
            </a>
            <a href="{{ route('clientes.edit', $cliente) }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
                Editar cliente
            </a>
            <form method="POST" action="{{ route('clientes.destroy', $cliente) }}" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                    Excluir cliente
                </button>
            </form>
        </div>
        
        <h2>Detalhes do Cliente</h2>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>    
        @endif

        <div class="cliente-card">
            @if($cliente->foto)
                <img src="{{ asset($cliente->foto) }}" alt="Foto do cliente" class="cliente-foto">
            @endif
            
            <div class="cliente-detail">
                <div class="detail-label">ID</div>
                <div class="detail-value">{{ $cliente->id }}</div>
            </div>
            <div class="cliente-detail">
                <div class="detail-label">Nome completo</div>
                <div class="detail-value">{{ $cliente->name }}</div>
            </div>
            <div class="cliente-detail">
                <div class="detail-label">E-mail</div>
                <div class="detail-value">{{ $cliente->email }}</div>
            </div>
            <div class="cliente-detail">
                <div class="detail-label">CPF/CNPJ</div>
                <div class="detail-value">{{ $cliente->cpf_cnpj_formatado }}</div>
            </div>
            @if($cliente->nome_social)
                <div class="cliente-detail">
                    <div class="detail-label">Nome Social</div>
                    <div class="detail-value">{{ $cliente->nome_social }}</div>
                </div>
            @endif
            @if($cliente->dt_nascimento)
                <div class="cliente-detail">
                    <div class="detail-label">Data de Nascimento</div>
                    <div class="detail-value">{{ $cliente->dt_nascimento->format('d/m/Y') }}</div>
                </div>
            @endif
            <div class="cliente-detail">
                <div class="detail-label">Cadastrado em</div>
                <div class="detail-value">{{ $cliente->created_at->format('d/m/Y H:i') }}</div>
            </div>
            <div class="cliente-detail">
                <div class="detail-label">Última atualização</div>
                <div class="detail-value">{{ $cliente->updated_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>
    </div>
</body>
</html>