# Teste da Funcionalidade "Novo Chamado"

## Como Testar

### 1. Backend (Laravel)
- Certifique-se de que o servidor Laravel está rodando: `php artisan serve`
- O servidor deve estar disponível em: `http://localhost:8000`

### 2. Frontend (Vue.js)
- Navegue para o frontend: `cd front-verdanaDesk`
- Instale as dependências: `npm install`
- Execute o servidor de desenvolvimento: `npm run dev`

### 3. Testando a Funcionalidade

1. **Acesse a Dashboard**
   - Faça login na aplicação
   - Você deve ver a dashboard com o botão "+ Novo Chamado"

2. **Criar um Novo Chamado**
   - Clique no botão "+ Novo Chamado"
   - Preencha os campos:
     - **Título**: "Teste de Chamado"
     - **Descrição**: "Este é um chamado de teste"
     - **Prioridade**: "Média"
     - **Status**: "Aberto"
   - Clique em "Criar"

3. **Verificar o Resultado**
   - O modal deve fechar automaticamente
   - A lista de chamados deve ser atualizada
   - O novo chamado deve aparecer na lista
   - As estatísticas devem ser atualizadas

### 4. Testando Validações

1. **Campos Obrigatórios**
   - Tente criar um chamado sem título ou descrição
   - Deve aparecer uma mensagem de erro

2. **Conexão com Backend**
   - Verifique se os dados estão sendo salvos no banco de dados
   - Verifique se o status está usando o enum do backend

### 5. Endpoints Testados

- `POST /api/tasks/create` - Criar novo chamado
- `GET /api/tasks/status-options` - Obter opções de status
- `GET /api/tasks` - Listar chamados

## Funcionalidades Implementadas

✅ **Botão "Novo Chamado"** - Abre modal de criação
✅ **Formulário de Criação** - Campos: título, descrição, prioridade, status
✅ **Validação de Campos** - Título e descrição obrigatórios
✅ **Integração com Backend** - Usa API para criar chamado
✅ **Feedback Visual** - Loading state durante criação
✅ **Tratamento de Erros** - Mensagens de erro amigáveis
✅ **Atualização Automática** - Lista recarrega após criação
✅ **Status do Backend** - Usa StatusTaskEnum do backend

## Estrutura dos Dados

```json
{
  "title": "Título do Chamado",
  "description": "Descrição detalhada",
  "priority": "medium",
  "status": "ABERTO"
}
```

## Status Disponíveis (do Backend)

- `ABERTO` - Chamado aberto
- `EM_ATENDIMENTO` - Em atendimento
- `ENCERRADO` - Chamado encerrado

## Prioridades Disponíveis

- `low` - Baixa
- `medium` - Média  
- `high` - Alta





