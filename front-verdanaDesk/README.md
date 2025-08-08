# VerdanaDesk Frontend

Frontend do sistema VerdanaDesk desenvolvido com Vue.js 3 e Vite.

## 🚀 Tecnologias

- **Vue.js 3**: Framework JavaScript reativo
- **Vite**: Build tool rápida
- **Composition API**: API moderna do Vue
- **CSS3**: Estilos customizados
- **Fetch API**: Comunicação com backend

## 📁 Estrutura do Projeto

```
src/
├── assets/
│   ├── styles/          # Estilos CSS
│   │   ├── auth.css     # Estilos de autenticação
│   │   ├── buttons.css  # Estilos de botões
│   │   ├── dashboard.css # Estilos do dashboard
│   │   ├── modal.css    # Estilos de modais
│   │   └── index.css    # Estilos globais
│   └── main.css         # CSS principal
├── components/          # Componentes Vue
│   ├── CreateTaskModal.vue
│   ├── EditTaskModal.vue
│   ├── TaskStats.vue
│   ├── TaskCard.vue
│   ├── TaskList.vue
│   ├── DashboardHeader.vue
│   ├── Notification.vue
│   └── index.js         # Exportações
├── composables/         # Lógica reutilizável
│   ├── useTasks.js      # Gerenciamento de tasks
│   ├── useAuth.js       # Autenticação
│   ├── useNotifications.js # Notificações
│   └── useTaskStyles.js # Cores e labels
├── services/            # Comunicação com API
│   └── api.js          # Cliente HTTP
├── views/              # Páginas da aplicação
│   ├── DashboardView.vue
│   ├── LoginView.vue
│   └── RegisterView.vue
├── router/             # Roteamento
│   └── index.js
├── constants/          # Constantes
│   └── status.js
├── App.vue            # Componente raiz
└── main.js           # Ponto de entrada
```

## 🏗️ Arquitetura Clean Code

### Composables (Lógica de Negócio)
- **`useTasks.js`**: Gerencia CRUD de chamados, loading states e estatísticas
- **`useAuth.js`**: Gerencia login, registro, logout e navegação
- **`useNotifications.js`**: Sistema de notificações com auto-dismiss
- **`useTaskStyles.js`**: Cores, labels e formatação de dados

### Componentes (UI Reutilizável)
- **`TaskStats.vue`**: Exibe estatísticas (total, aberto, fechado)
- **`TaskCard.vue`**: Card individual de chamado com ações
- **`TaskList.vue`**: Lista de chamados com loading/empty states
- **`DashboardHeader.vue`**: Header com ações principais
- **`Notification.vue`**: Sistema de notificações

### Views (Orquestração)
- **`DashboardView.vue`**: Dashboard principal com composição de componentes
- **`LoginView.vue`**: Tela de login simplificada
- **`RegisterView.vue`**: Tela de registro simplificada

## 🚀 Instalação

### Pré-requisitos
- Node.js 16+
- npm ou yarn

### Setup
```bash
# Instalar dependências
npm install

# Criar arquivo de ambiente
echo "VITE_API_BASE_URL=http://localhost:8000/api" > .env

# Iniciar servidor de desenvolvimento
npm run dev
```

## 📦 Scripts Disponíveis

```bash
# Desenvolvimento
npm run dev          # Inicia servidor de desenvolvimento
npm run build        # Build para produção
npm run preview      # Preview do build

# Linting
npm run lint         # Executar ESLint
npm run lint:fix     # Corrigir problemas de linting
```

## 🎨 Sistema de Estilos

### CSS Custom Properties
```css
:root {
  --color-primary: #3b82f6;
  --color-success: #10b981;
  --color-warning: #f59e0b;
  --color-danger: #ef4444;
  --color-text: #1f2937;
  --color-background: #ffffff;
}
```

### Classes Utilitárias
- `.btn`: Botões base
- `.btn-primary`: Botão primário
- `.btn-secondary`: Botão secundário
- `.btn-danger`: Botão de perigo
- `.btn-success`: Botão de sucesso

## 🔧 Configuração

### Variáveis de Ambiente
```env
VITE_API_BASE_URL=http://localhost:8000/api
```

### Vite Config
```javascript
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
})
```

## 📱 Responsividade

O sistema é totalmente responsivo com breakpoints:
- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

## 🎯 Funcionalidades

### Dashboard
- ✅ Estatísticas em tempo real
- ✅ Lista de chamados com paginação
- ✅ Filtros por status e prioridade
- ✅ Ações: editar, fechar, excluir

### Autenticação
- ✅ Login com validação
- ✅ Registro de usuários
- ✅ Logout seguro
- ✅ Proteção de rotas

### Interface
- ✅ Design responsivo
- ✅ Notificações elegantes
- ✅ Loading states
- ✅ Modais interativos

## 🧪 Testes

```bash
# Executar testes unitários
npm run test

# Executar testes com coverage
npm run test:coverage
```

## 📈 Performance

### Otimizações Implementadas
- ✅ **Lazy Loading**: Componentes carregados sob demanda
- ✅ **Code Splitting**: Separação automática de chunks
- ✅ **Tree Shaking**: Remoção de código não utilizado
- ✅ **Minificação**: CSS e JS otimizados

### Métricas
- **First Contentful Paint**: < 1.5s
- **Largest Contentful Paint**: < 2.5s
- **Cumulative Layout Shift**: < 0.1

## 🔒 Segurança

### Implementações
- ✅ **CORS**: Configurado corretamente
- ✅ **XSS Protection**: Sanitização de dados
- ✅ **CSRF Protection**: Tokens de segurança
- ✅ **Input Validation**: Validação client-side

## 🐛 Debugging

### DevTools
```javascript
// Habilitar debug
localStorage.setItem('debug', 'true')

// Ver logs detalhados
console.log('Debug mode enabled')
```

### Erros Comuns
1. **CORS Error**: Verificar configuração do backend
2. **API Connection**: Verificar URL da API
3. **Build Errors**: Limpar cache do Vite

## 📚 Documentação Adicional

- [Vue.js 3 Documentation](https://vuejs.org/)
- [Vite Documentation](https://vitejs.dev/)
- [Composition API Guide](https://vuejs.org/guide/extras/composition-api-faq.html)

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma feature branch
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

---

**VerdanaDesk Frontend** - Interface moderna e responsiva! 🎨
