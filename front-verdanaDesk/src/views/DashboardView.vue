<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { api } from '@/services/api'
import { CreateTaskModal, EditTaskModal } from '@/components'

const router = useRouter()
const tasks = ref([])
const loading = ref(true)
const showCreateModal = ref(false)
const showEditModal = ref(false)
const selectedTask = ref(null)



// Load tasks
async function loadTasks() {
  try {
    loading.value = true
    const response = await api.getTasks()
    tasks.value = response
  } catch (error) {
    console.error('Erro ao carregar tarefas:', error)
  } finally {
    loading.value = false
  }
}

// Create task
async function createTask(taskData) {
  try {
    await api.createTask(taskData)
    showCreateModal.value = false
    await loadTasks()
  } catch (error) {
    console.error('Erro ao criar tarefa:', error)
  }
}

// Edit task
async function updateTask(taskData) {
  try {
    await api.updateTask(selectedTask.value.id, taskData)
    showEditModal.value = false
    selectedTask.value = null
    await loadTasks()
  } catch (error) {
    console.error('Erro ao atualizar tarefa:', error)
  }
}

// Close task
async function closeTask(taskId) {
  try {
    await api.closeTask(taskId)
    await loadTasks()
  } catch (error) {
    console.error('Erro ao fechar tarefa:', error)
  }
}

// Delete task
async function deleteTask(taskId) {
  if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
    try {
      await api.deleteTask(taskId)
      await loadTasks()
    } catch (error) {
      console.error('Erro ao excluir tarefa:', error)
    }
  }
}

// Open edit modal
function openEditModal(task) {
  selectedTask.value = task
  showEditModal.value = true
}

// Logout
function logout() {
  api.setAuthToken('')
  router.push({ name: 'login' })
}

// Priority colors
const priorityColors = {
  low: '#10b981',
  medium: '#f59e0b',
  high: '#ef4444'
}

// Status colors
const statusColors = {
  open: '#3b82f6',
  in_progress: '#f59e0b',
  closed: '#10b981'
}

onMounted(() => {
  loadTasks()
})
</script>

<template>
  <div class="dashboard">
    <!-- Header -->
    <header class="header">
      <div class="header-content">
        <h1>Dashboard de Chamados</h1>
        <div class="header-actions">
          <button @click="showCreateModal = true" class="btn btn-primary">
            + Novo Chamado
          </button>
          <button @click="logout" class="btn btn-secondary">
            Sair
          </button>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <h3>Total</h3>
          <p class="stat-number">{{ tasks.length }}</p>
        </div>
        <div class="stat-card">
          <h3>Em Aberto</h3>
          <p class="stat-number">{{ tasks.filter(t => t.status === 'open').length }}</p>
        </div>
        
        <div class="stat-card">
          <h3>Fechados</h3>
          <p class="stat-number">{{ tasks.filter(t => t.status === 'closed').length }}</p>
        </div>
      </div>

      <!-- Tasks List -->
      <div class="tasks-section">
        <h2>Chamados</h2>
        
        <div v-if="loading" class="loading">
          <p>Carregando chamados...</p>
        </div>

        <div v-else-if="tasks.length === 0" class="empty-state">
          <p>Nenhum chamado encontrado.</p>
          <button @click="showCreateModal = true" class="btn btn-primary">
            Criar primeiro chamado
          </button>
        </div>

        <div v-else class="tasks-grid">
          <div 
            v-for="task in tasks" 
            :key="task.id" 
            class="task-card"
            :class="`priority-${task.priority} status-${task.status}`"
          >
            <div class="task-header">
              <h3>{{ task.title }}</h3>
              <div class="task-badges">
                <span 
                  class="badge priority" 
                  :style="{ backgroundColor: priorityColors[task.priority] }"
                >
                  {{ task.priority === 'low' ? 'Baixa' : task.priority === 'medium' ? 'Média' : 'Alta' }}
                </span>
                <span 
                  class="badge status" 
                  :style="{ backgroundColor: statusColors[task.status] }"
                >
                  {{ task.status === 'open' ? 'Aberto' : task.status === 'in_progress' ? 'Em Progresso' : 'Fechado' }}
                </span>
              </div>
            </div>
            
            <p class="task-description">{{ task.description }}</p>
            
            <div class="task-footer">
              <div class="task-actions">
                <button @click="openEditModal(task)" class="btn btn-small">
                  Editar
                </button>
                <button 
                  v-if="task.status !== 'closed'" 
                  @click="closeTask(task.id)" 
                  class="btn btn-small btn-success"
                >
                  Fechar
                </button>
                <button @click="deleteTask(task.id)" class="btn btn-small btn-danger">
                  Excluir
                </button>
              </div>
              <small class="task-date">
                Criado em {{ new Date(task.created_at).toLocaleDateString('pt-BR') }}
              </small>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Modals -->
    <CreateTaskModal 
      :show="showCreateModal"
      @close="showCreateModal = false"
      @submit="createTask"
    />
    
    <EditTaskModal 
      :show="showEditModal"
      :task="selectedTask"
      @close="showEditModal = false"
      @submit="updateTask"
    />
  </div>
</template>




