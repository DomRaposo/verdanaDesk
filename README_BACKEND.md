# VerdanaDesk Backend

Backend do sistema VerdanaDesk desenvolvido com Laravel 10 e PHP 8.2+.

## 🚀 Tecnologias

- **Laravel 10.x**: Framework PHP elegante
- **Laravel Sanctum**: Autenticação API
- **MySQL 8.0+**: Banco de dados relacional
- **PHP 8.2+**: Linguagem de programação
- **Eloquent ORM**: Mapeamento objeto-relacional

## 📁 Estrutura do Projeto

```
app/
├── Console/
│   └── Kernel.php              # Comandos do console
├── Enums/
│   └── StatusTaskEnum.php      # Enum para status de tasks
├── Exceptions/
│   └── Handler.php             # Tratamento de exceções
├── Http/
│   ├── Controllers/            # Controladores da API
│   │   ├── AuthController.php  # Autenticação
│   │   ├── TaskController.php  # Gerenciamento de tasks
│   │   └── UserController.php  # Gerenciamento de usuários
│   ├── Middleware/             # Middlewares
│   │   ├── Authenticate.php    # Autenticação
│   │   ├── EncryptCookies.php # Criptografia de cookies
│   │   └── HandleCors.php     # CORS
│   └── Requests/               # Validação de requests
│       ├── Auth/
│       ├── Task/
│       └── User/
├── Models/                     # Modelos Eloquent
│   ├── Task.php               # Modelo de Task
│   └── User.php               # Modelo de User
├── Providers/                  # Service Providers
│   ├── AppServiceProvider.php
│   ├── AuthServiceProvider.php
│   └── RouteServiceProvider.php
├── Repositories/               # Padrão Repository
│   ├── AuthRepository.php
│   ├── TaskRepository.php
│   └── UserRepository.php
└── Services/                   # Lógica de negócio
    ├── AuthService.php
    ├── TaskService.php
    └── UserService.php
```

## 🏗️ Arquitetura

### Padrão Repository
```php
// Exemplo: TaskRepository
class TaskRepository
{
    public function getAll(): Collection
    public function findById(int $id): ?Task
    public function create(array $data): Task
    public function update(Task $task, array $data): bool
    public function delete(Task $task): bool
}
```

### Service Layer
```php
// Exemplo: TaskService
class TaskService
{
    public function index(): Collection
    public function store(array $data): array
    public function update(int $id, array $data): array
    public function destroy(int $id): array
    public function closeChamado(int $id): array
}
```

### Controllers Slim
```php
// Exemplo: TaskController
class TaskController extends Controller
{
    public function index()     // GET /api/tasks
    public function store()     // POST /api/tasks/create
    public function show()      // GET /api/tasks/{id}
    public function update()    // PUT /api/tasks/{id}
    public function destroy()   // DELETE /api/tasks/{id}
    public function close()     // POST /api/tasks/{id}/close
}
```

## 🚀 Instalação

### Pré-requisitos
- PHP 8.2+
- Composer 2.0+
- MySQL 8.0+
- XAMPP (recomendado)

### Setup
```bash
# Instalar dependências
composer install

# Copiar arquivo de configuração
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Configurar banco de dados
php artisan migrate

# Executar seeders
php artisan db:seed

# Iniciar servidor
php artisan serve --host=0.0.0.0 --port=8000
```

## 🔧 Configuração

### Variáveis de Ambiente (.env)
```env
APP_NAME=VerdanaDesk
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=verdana_desk
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost:5173
SESSION_DOMAIN=localhost
```

### CORS Configuration
```php
// config/cors.php
'allowed_origins' => ['*'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
'supports_credentials' => true,
```

## 🎯 API Endpoints

### Autenticação
| Método | Endpoint | Descrição |
|--------|----------|-----------|
| POST | `/api/login` | Login de usuário |
| POST | `/api/logout` | Logout de usuário |
| POST | `/api/users` | Registro de usuário |

### Tasks
| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/tasks` | Listar todas as tasks |
| POST | `/api/tasks/create` | Criar nova task |
| GET | `/api/tasks/{id}` | Buscar task específica |
| PUT | `/api/tasks/{id}` | Atualizar task |
| DELETE | `/api/tasks/{id}` | Excluir task |
| POST | `/api/tasks/{id}/close` | Fechar task |

### Usuários
| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/users` | Listar usuários |
| GET | `/api/users/{id}` | Buscar usuário |
| PUT | `/api/users/{id}` | Atualizar usuário |
| DELETE | `/api/users/{id}` | Excluir usuário |

## 📊 Banco de Dados

### Migrations
```bash
# Executar migrations
php artisan migrate

# Reverter migrations
php artisan migrate:rollback

# Ver status das migrations
php artisan migrate:status
```

### Seeders
```bash
# Executar seeders
php artisan db:seed

# Executar seeder específico
php artisan db:seed --class=DatabaseSeeder
```

### Estrutura das Tabelas

#### Users
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

#### Tasks
```sql
CREATE TABLE tasks (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    status ENUM('ABERTO', 'EM_ATENDIMENTO', 'ENCERRADO') DEFAULT 'ABERTO',
    priority VARCHAR(50) DEFAULT 'medium',
    user_id BIGINT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

## 🔐 Autenticação

### Laravel Sanctum
```php
// Configuração em config/sanctum.php
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
    env('APP_URL') ? ','.parse_url(env('APP_URL'), PHP_URL_HOST) : ''
))),
```

### Middleware de Autenticação
```php
// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
});
```

## 🧪 Testes

### Executar Testes
```bash
# Todos os testes
php artisan test

# Testes específicos
php artisan test --filter=TaskControllerTest

# Com coverage
php artisan test --coverage
```

### Testes de API
```bash
# Testar endpoint de login
php test_login.php

# Testar endpoint de tasks
php test_tasks_api.php
```

## 🔍 Debugging

### Logs
```bash
# Ver logs em tempo real
tail -f storage/logs/laravel.log

# Limpar logs
php artisan log:clear
```

### Tinker
```bash
# Acessar console interativo
php artisan tinker

# Exemplos de comandos
App\Models\User::count();
App\Models\Task::where('status', 'ABERTO')->get();
```

## 📈 Performance

### Otimizações
- ✅ **Query Optimization**: Eager loading com Eloquent
- ✅ **Caching**: Cache de configurações e rotas
- ✅ **Indexing**: Índices nas colunas mais consultadas
- ✅ **Pagination**: Paginação para grandes datasets

### Monitoramento
```bash
# Ver queries executadas
php artisan telescope:install

# Monitorar performance
php artisan queue:work
```

## 🔒 Segurança

### Implementações
- ✅ **CORS**: Configurado corretamente
- ✅ **CSRF Protection**: Tokens de segurança
- ✅ **Input Validation**: Validação de dados
- ✅ **SQL Injection**: Proteção via Eloquent
- ✅ **XSS Protection**: Sanitização automática

### Headers de Segurança
```php
// Adicionar headers de segurança
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
```

## 🚀 Deploy

### Produção
```bash
# Otimizar para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verificar permissões
chmod -R 755 storage bootstrap/cache
```

### Docker (Opcional)
```dockerfile
FROM php:8.2-fpm
COPY . /var/www/html
RUN composer install --no-dev --optimize-autoloader
```

## 📚 Documentação Adicional

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sanctum](https://laravel.com/docs/sanctum)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Laravel Testing](https://laravel.com/docs/testing)

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma feature branch
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

---

**VerdanaDesk Backend** - API robusta e escalável! 🚀


