# Consumo do StatusTaskEnum do Backend

## Mudanças Implementadas

### Backend (Laravel)

1. **TaskController.php**
   - Adicionado import do `StatusTaskEnum`
   - Validação de status agora usa valores do enum: `StatusTaskEnum::values()`
   - Método `getStatusOptions()` criado para fornecer opções de status ao frontend
   - Valores padrão agora usam o enum: `StatusTaskEnum::ABERTO->value`

2. **Task.php (Model)**
   - Adicionado cast para o enum: `'status' => StatusTaskEnum::class`
   - Método `getStatusOptions()` para acessar valores do enum

3. **Rotas (api.php)**
   - Nova rota: `GET /api/tasks/status-options` para obter opções de status

### Frontend (Vue.js)

1. **API Service (api.js)**
   - Nova função: `getStatusOptions()` para consumir dados do backend

2. **Composable (useStatus.js)**
   - Novo composable para gerenciar status do backend
   - Função `loadStatusFromBackend()` para carregar dados
   - Funções utilitárias para exibição e cores

3. **Constantes (status.js)**
   - Função `updateStatusFromBackend()` para atualizar constantes com dados do backend
   - Mantém compatibilidade com código existente

4. **Componentes Atualizados**
   - `DashboardView.vue`: Usa composable para carregar status do backend
   - `CreateTaskModal.vue`: Usa composable para opções de status
   - `EditTaskModal.vue`: Usa composable para opções de status

## Como Funciona

1. **Inicialização**: Quando a aplicação carrega, o `DashboardView` chama `loadStatusFromBackend()`
2. **Backend**: A rota `/api/tasks/status-options` retorna:
   ```json
   {
     "status_options": ["ABERTO", "EM_ATENDIMENTO", "ENCERRADO"],
     "status_cases": [
       {"value": "ABERTO", "label": "ABERTO"},
       {"value": "EM_ATENDIMENTO", "label": "EM_ATENDIMENTO"},
       {"value": "ENCERRADO", "label": "ENCERRADO"}
     ]
   }
   ```
3. **Frontend**: Os dados são processados e as constantes são atualizadas dinamicamente
4. **Uso**: Todos os componentes agora usam os dados do backend ao invés de valores hardcoded

## Vantagens

- **Centralização**: Status é gerenciado apenas no backend
- **Consistência**: Mesmos valores em frontend e backend
- **Manutenibilidade**: Mudanças no enum são refletidas automaticamente no frontend
- **Flexibilidade**: Fácil adicionar novos status no futuro

## Endpoints Disponíveis

- `GET /api/tasks/status-options` - Retorna opções de status do enum
- `POST /api/tasks/create` - Cria tarefa com validação baseada no enum
- `PUT /api/tasks/{id}` - Atualiza tarefa com validação baseada no enum

## Exemplo de Uso

```javascript
// No frontend
import { useStatus } from '@/composables/useStatus'

const { STATUS, STATUS_OPTIONS, loadStatusFromBackend } = useStatus()

// Carregar status do backend
await loadStatusFromBackend()

// Usar em formulários
const formData = {
  status: STATUS.ABERTO // Valor do enum
}
```





