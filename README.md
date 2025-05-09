# 📝 Desafio - Sistema de Gerenciamento de Clientes

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php)
![SQLite](https://img.shields.io/badge/SQLite-3.x-003B57?logo=sqlite)

## 📋 Descrição

Aplicação Laravel para gerenciamento de clientes com CRUD completo, utilizando SQLite como banco de dados principal.

## ✨ Funcionalidades

- Cadastro de clientes com foto
- Listagem de clientes  
- Remoção de clientes
- Edição de clientes
- Sistema de armazenamento local de fotos

## 🚀 Pré-requisitos

Antes de começar, verifique se você possui os seguintes requisitos instalados:

- PHP 8.1 ou superior
- Composer 2.x
- Laravel 12.x
- SQLite 3
- Node.js 16+ (opcional para desenvolvimento)

## 🛠️ Instalação

Siga estes passos para configurar o ambiente de desenvolvimento:

### 1. Clonar o repositório

```bash
git clone https://github.com/IHugoCezar/crud-cliente-laravel.git
cd desafio
```

### 2. Instalar dependências

```bash
composer install
```

### 3. Configurar ambiente

Crie o arquivo do banco de dados SQLite:

```bash
touch database/database.sqlite
```

Copie o arquivo `.env.example` para `.env`:

```bash
cp .env.example .env
```

### 4. Gerar chave da aplicação

```bash
php artisan key:generate
```

### 5. Configurar o arquivo .env

Verifique se as seguintes configurações estão definidas no arquivo `.env`:

```ini
DB_CONNECTION=sqlite
# Comente ou remova as outras configurações de DB
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

### 6. Executar migrações

```bash
php artisan migrate
```
### 7. Cria um link simbólico de armazenamento

```bash
php artisan storage:link
```

### 8. Iniciar o servidor de desenvolvimento

```bash
php artisan serve
```

A aplicação estará disponível em: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 📦 Estrutura do Projeto

```
desafio/
├── app/                  # Código fonte da aplicação
│   ├── Http/             # Controllers e Requests
│   ├── Models/           # Modelos Eloquent
├── config/               # Arquivos de configuração
├── database/
│   ├── migrations/       # Migrations do banco de dados
│   └── database.sqlite   # Banco de dados SQLite
├── public/               # Arquivos públicos
├── resources/            # Views e assets
├── routes/               # Definição de rotas
├── storage/              # Arquivos de armazenamento
├── tests/                # Testes automatizados
└── vendor/               # Dependências do Composer
```

## 🔧 Comandos Artisan Úteis

| Comando | Descrição |
|---------|-----------|
| `php artisan migrate` | Executa as migrações do banco de dados |
| `php artisan migrate:fresh` | Recria todo o banco de dados |
| `php artisan db:seed` | Popula o banco com dados de teste |
| `php artisan storage:link` | Cria link simbólico para armazenamento |

## 📄 Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.