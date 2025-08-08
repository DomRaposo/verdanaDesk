# VerdanaDesk - Sistema de Gerenciamento de Chamados

![Laravel](https://img.shields.io/badge/Laravel-10.x-red)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-green)
![PHP](https://img.shields.io/badge/PHP-8.2+-purple)

## 📋 Descrição

O **VerdanaDesk** é um sistema moderno de gerenciamento de chamados desenvolvido com Laravel (backend) e Vue.js (frontend). O projeto segue os princípios de Clean Code Architecture, oferecendo uma interface intuitiva para criação, edição e acompanhamento de chamados técnicos.

## ✨ Funcionalidades

### 🔐 Autenticação
- **Login/Logout**: Sistema de autenticação seguro
- **Registro**: Cadastro de novos usuários
- **Tokens JWT**: Autenticação via Laravel Sanctum

### 📊 Dashboard
- **Visão Geral**: Estatísticas em tempo real
- **Contadores**: Total, em aberto e fechados
- **Filtros**: Por status

### 🎫 Gerenciamento de Chamados
- **CRUD Completo**: Criar, ler, atualizar e excluir chamados
- **Status**: Aberto, Em Progresso, Fechado
- **Ações**: Editar, fechar e excluir chamados

### 🎨 Interface
- **Design Responsivo**: Funciona em desktop e mobile
- **Notificações**: Feedback visual para ações
- **Loading States**: Indicadores de carregamento
- **Modais**: Interface moderna para edição

## 🏗️ Arquitetura

### Backend (Laravel)
```
app/
├── Controllers/     # Controladores da API
├── Services/        # Lógica de negócio
├── Repositories/    # Acesso a dados
├── Models/          # Modelos Eloquent
├── Enums/           # Enums para status
└── Http/
    └── Middleware/  # Middlewares (CORS, Auth)
```

### Frontend (Vue.js)
```
src/
├── composables/     # Lógica reutilizável
├── components/      # Componentes Vue
├── views/          # Páginas da aplicação
├── services/       # Comunicação com API
└── assets/         # Estilos e recursos
```

## 🚀 Tecnologias

### Backend
- **Laravel 10.x**: Framework PHP
- **Laravel Sanctum**: Autenticação API
- **MySQL**: Banco de dados
- **PHP 8.2+**: Linguagem de programação

### Frontend
- **Vue.js 3**: Framework JavaScript
- **Vite**: Build tool
- **Composition API**: API moderna do Vue
- **CSS3**: Estilos customizados

## 📦 Instalação

### Pré-requisitos
- PHP 8.2+
- Composer
- Node.js 16+
- MySQL 8.0+

### 1. Clone o repositório
```bash
git clone https://github.com/DomRaposo/verdanaDesk
cd verdanaDesk
```

### 2. Configure o Backend (Laravel)

```bash
# Instalar dependências
composer install

# Copiar arquivo de configuração
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Executar migrations
php artisan migrate

# Executar seeders (cria usuário de teste)
php artisan db:seed

# Iniciar servidor
php artisan serve --host=0.0.0.0 --port=8000
```

### 3. Configure o Frontend (Vue.js)

```bash
# Navegar para pasta do frontend
cd front-verdanaDesk

# Instalar dependências
npm install

# Criar arquivo .env
echo "VITE_API_BASE_URL=http://localhost:8000/api" > .env

# Iniciar servidor de desenvolvimento
npm run dev
```

### 4. Acesse a aplicação
- **Frontend**: http://localhost:5173
- **Backend API**: http://localhost:8000/api


## 🔧 Configuração do Ambiente

### CORS
O sistema está configurado para aceitar requisições de:
- http://localhost:5173 (Vite dev server)
- http://localhost:3000
- http://localhost:8080

### Variáveis de Ambiente

#### Backend (.env)
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
```

#### Frontend (.env)
```env
VITE_API_BASE_URL=http://localhost:8000/api
```

## 📚 Estrutura do Projeto

### Clean Code Architecture

O projeto segue os princípios de Clean Code Architecture:

#### Composables (Lógica de Negócio)
- `useTasks.js`: Gerenciamento de chamados
- `useAuth.js`: Autenticação e navegação
- `useNotifications.js`: Sistema de notificações
- `useTaskStyles.js`: Cores e labels

#### Componentes (UI Reutilizável)
- `TaskStats.vue`: Estatísticas
- `TaskCard.vue`: Card de chamado
- `TaskList.vue`: Lista de chamados
- `DashboardHeader.vue`: Header da aplicação
- `Notification.vue`: Notificações

#### Views (Orquestração)
- `DashboardView.vue`: Dashboard principal
- `LoginView.vue`: Tela de login
- `RegisterView.vue`: Tela de registro

## 🎯 API Endpoints

### Autenticação
```
POST /api/login          # Login
POST /api/logout         # Logout
POST /api/users          # Registro
```

### Chamados
```
GET    /api/tasks              # Listar todos
POST   /api/tasks/create       # Criar chamado
GET    /api/tasks/{id}         # Ver chamado
PUT    /api/tasks/{id}         # Atualizar chamado
DELETE /api/tasks/{id}         # Excluir chamado
POST   /api/tasks/{id}/close   # Fechar chamado
```

## 🧪 Testes

### Backend
```bash
# Executar testes
php artisan test

# Testar API
php test_api.php
```

### Frontend
```bash
# Executar testes
npm run test

# Build para produção
npm run build
```

## 🔄 Fluxo de Desenvolvimento

### 1. Desenvolvimento
```bash
# Terminal 1 - Backend
php artisan serve

# Terminal 2 - Frontend
cd front-verdanaDesk
npm run dev
```

### 2. Build para Produção
```bash
# Frontend
npm run build

# Backend
php artisan config:cache
php artisan route:cache
```

## 🐛 Troubleshooting

### Problemas Comuns

#### CORS Error
```bash
# Limpar cache
php artisan config:clear
php artisan route:clear
```

#### Tasks não aparecem
```bash
# Verificar se o usuário existe
php artisan tinker
App\Models\User::where('email', 'teste@raposo.com')->first();
```

#### Erro de conexão com API
```bash
# Verificar se o servidor está rodando
netstat -an | findstr :8000
```

## 📈 Melhorias Futuras

- [ ] **Filtros Avançados**: Por data, usuário
- [ ] **Relatórios**: Exportação de dados
- [ ] **Notificações**: Sistema de notificações em tempo real
- [ ] **Upload de Arquivos**: Anexos nos chamados
- [ ] **Dashboard Avançado**: Gráficos e métricas
- [ ] **Múltiplos Usuários**: Sistema de permissões
- [ ] **API Documentation**: Swagger/OpenAPI

## 👨‍💻 Autor

**VerdanaDesk Team**
- Email: felipe_ol@outlook.com
- GitHub: [@DomRaposo](https://github.com/DomRaposo/verdanaDesk)
-Desenvolvido por: Felipe Oliveira
## 🙏 Agradecimentos

- Laravel Team pelo framework incrível
- Vue.js Team pela biblioteca reativa

---

