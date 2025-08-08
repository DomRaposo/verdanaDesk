import { ref } from 'vue'
import { api } from '@/services/api'

export function useTasks() {
  const tasks = ref([])
  const loading = ref(true)
  const deletingTasks = ref(new Set())

  const loadTasks = async () => {
    try {
      loading.value = true
      const response = await api.getTasks()
      tasks.value = response
    } catch (error) {
      console.error('Erro ao carregar tarefas:', error)
      throw error
    } finally {
      loading.value = false
    }
  }

  const createTask = async (taskData) => {
    try {
      await api.createTask(taskData)
      await loadTasks()
    } catch (error) {
      console.error('Erro ao criar tarefa:', error)
      throw error
    }
  }

  const updateTask = async (taskId, taskData) => {
    try {
      await api.updateTask(taskId, taskData)
      await loadTasks()
    } catch (error) {
      console.error('Erro ao atualizar tarefa:', error)
      throw error
    }
  }

  const closeTask = async (taskId) => {
    try {
      await api.closeTask(taskId)
      await loadTasks()
    } catch (error) {
      console.error('Erro ao fechar tarefa:', error)
      throw error
    }
  }

  const deleteTask = async (taskId) => {
    const task = tasks.value.find(t => t.id === taskId)
    const taskTitle = task ? task.title : 'esta tarefa'
    
    if (confirm(`Tem certeza que deseja excluir "${taskTitle}"?\n\nEsta ação não pode ser desfeita.`)) {
      try {
        deletingTasks.value.add(taskId)
        await api.deleteTask(taskId)
        await loadTasks()
        return { success: true, message: 'Tarefa excluída com sucesso!' }
      } catch (error) {
        console.error('Erro ao excluir tarefa:', error)
        throw error
      } finally {
        deletingTasks.value.delete(taskId)
      }
    }
    return { success: false }
  }

  const getTaskStats = () => {
    const total = tasks.value.length
    const open = tasks.value.filter(t => t.status === 'open').length
    const closed = tasks.value.filter(t => t.status === 'closed').length
    
    return { total, open, closed }
  }

  return {
    tasks,
    loading,
    deletingTasks,
    loadTasks,
    createTask,
    updateTask,
    closeTask,
    deleteTask,
    getTaskStats
  }
}
