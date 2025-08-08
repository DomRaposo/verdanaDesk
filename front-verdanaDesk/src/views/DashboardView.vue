<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { api } from '@/services/api'
import { 
  CreateTaskModal, 
  EditTaskModal, 
  TaskStats, 
  TaskList, 
  DashboardHeader, 
  Notification 
} from '@/components'
import { useTasks } from '@/composables/useTasks'
import { useNotifications } from '@/composables/useNotifications'
import { useAuth } from '@/composables/useAuth'

const router = useRouter()

// Composables
const { 
  tasks, 
  loading, 
  deletingTasks, 
  loadTasks, 
  createTask, 
  updateTask, 
  closeTask, 
  deleteTask, 
  getTaskStats 
} = useTasks()

const { notification, showNotification } = useNotifications()
const { logout } = useAuth()

// Modal states
const showCreateModal = ref(false)
const showEditModal = ref(false)
const selectedTask = ref(null)

// Event handlers
const handleCreateTask = async (taskData) => {
  try {
    await createTask(taskData)
    showCreateModal.value = false
    showNotification('Tarefa criada com sucesso!', 'success')
  } catch (error) {
    showNotification(`Erro ao criar tarefa: ${error.message}`, 'error')
  }
}

const handleUpdateTask = async (taskData) => {
  try {
    await updateTask(selectedTask.value.id, taskData)
    showEditModal.value = false
    selectedTask.value = null
    showNotification('Tarefa atualizada com sucesso!', 'success')
  } catch (error) {
    showNotification(`Erro ao atualizar tarefa: ${error.message}`, 'error')
  }
}

const handleCloseTask = async (taskId) => {
  try {
    await closeTask(taskId)
    showNotification('Tarefa fechada com sucesso!', 'success')
  } catch (error) {
    showNotification(`Erro ao fechar tarefa: ${error.message}`, 'error')
  }
}

const handleDeleteTask = async (taskId) => {
  try {
    const result = await deleteTask(taskId)
    if (result.success) {
      showNotification(result.message, 'success')
    }
  } catch (error) {
    showNotification(`Erro ao excluir tarefa: ${error.message}`, 'error')
  }
}

const handleEditTask = (task) => {
  selectedTask.value = task
  showEditModal.value = true
}

const handleLogout = () => {
  logout()
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

// Initialize
onMounted(() => {
  loadTasks()
})
</script>

<template>
  <div class="dashboard">
    <Notification :notification="notification" />
    
    <DashboardHeader 
      @create="showCreateModal = true"
      @logout="handleLogout"
    />

    <main class="main-content">
      <TaskStats :stats="getTaskStats()" />
      
      <TaskList
        :tasks="tasks"
        :loading="loading"
        :deleting-tasks="deletingTasks"
        @edit="handleEditTask"
        @close="handleCloseTask"
        @delete="handleDeleteTask"
        @create="showCreateModal = true"
      />
    </main>

    <CreateTaskModal 
      :show="showCreateModal"
      @close="showCreateModal = false"
      @submit="handleCreateTask"
    />
    
    <EditTaskModal 
      :show="showEditModal"
      :task="selectedTask"
      @close="showEditModal = false"
      @submit="handleUpdateTask"
    />
  </div>
</template>





