<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Cliente | Desafio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet"> 
</head>
<body>
    <div class="container">
        <div class="nav-links">
            <a href="{{ route('clientes.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Voltar para lista
            </a>
            <a href="{{ route('clientes.show', $cliente) }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
                Visualizar cliente
            </a>
        </div>
        
        <h2>Editar Cliente</h2>

        @if($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('clientes.update', $cliente) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome completo*</label>
                <input type="text" id="name" name="name" placeholder="Digite o nome completo" value="{{ old('name', $cliente->name) }}" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail*</label>
                <input type="email" id="email" name="email" placeholder="Digite o e-mail" value="{{ old('email', $cliente->email) }}" required>
            </div>

            <div class="form-group">
                <label for="dt_nascimento">Data de Nascimento</label>
                <input type="date" id="dt_nascimento" name="dt_nascimento" value="{{ old('dt_nascimento', $cliente->dt_nascimento ? $cliente->dt_nascimento->format('Y-m-d') : '') }}">
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ*</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite CPF (11 dígitos) ou CNPJ (14 dígitos)" value="{{ old('cpf_cnpj', $cliente->cpf_cnpj) }}" required>
                <small class="error-message">Digite apenas números</small>
            </div>

            <div class="form-group">
                <label for="nome_social">Nome Social</label>
                <input type="text" id="nome_social" name="nome_social" placeholder="Digite o nome social (se houver)" value="{{ old('nome_social', $cliente->nome_social) }}">
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                @if($cliente->foto)
                    <img src="{{ asset($cliente->foto) }}" alt="Foto atual" class="foto-preview">
                @endif
                <input type="file" id="foto" name="foto" accept="image/*">
                <small class="error-message">Formatos aceitos: jpeg, png, jpg, gif (até 2MB)</small>
            </div>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>

    <script>
        document.getElementById('cpf_cnpj').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });
    </script>
</body>
</html>