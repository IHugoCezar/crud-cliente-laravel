<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Cliente | Desafio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/create.css') }}" rel="stylesheet"> 
</head>
<body>
    <div class="container">
        <a href="{{ route('clientes.index') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Voltar para lista
        </a>
        
        <h2>Cadastrar Cliente</h2>

        @if($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nome completo*</label>
                <input type="text" id="name" name="name" placeholder="Digite o nome completo" value="{{ old('name') }}" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail*</label>
                <input type="email" id="email" name="email" placeholder="Digite o e-mail" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="dt_nascimento">Data de Nascimento</label>
                <input type="date" id="dt_nascimento" name="dt_nascimento" value="{{ old('dt_nascimento') }}">
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ*</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite CPF (11 dígitos) ou CNPJ (14 dígitos)" value="{{ old('cpf_cnpj') }}" required>
                <small class="text-muted">Digite apenas números</small>
            </div>

            <div class="form-group">
                <label for="nome_social">Nome Social</label>
                <input type="text" id="nome_social" name="nome_social" placeholder="Digite o nome social (se houver)" value="{{ old('nome_social') }}">
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" id="foto" name="foto" accept="image/*">
                <small class="text-muted">Formatos aceitos: jpeg, png, jpg, gif (até 2MB)</small>
            </div>

            <button type="submit">Cadastrar Cliente</button>
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