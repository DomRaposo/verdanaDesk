import { ref, onMounted } from 'vue'
import { api } from '@/services/api'
import { updateStatusFromBackend, STATUS, STATUS_DISPLAY, STATUS_VALUES, STATUS_OPTIONS } from '@/constants/status'

export function useStatus() {
  const isLoading = ref(false)
  const error = ref(null)

  const loadStatusFromBackend = async () => {
    try {
      isLoading.value = true
      error.value = null
      
      const data = await api.getStatusOptions()
      updateStatusFromBackend(data)
      
      return data
    } catch (err) {
      error.value = err.message
      console.error('Erro ao carregar status do backend:', err)
    } finally {
      isLoading.value = false
    }
  }

  const getStatusDisplay = (status) => {
    return STATUS_DISPLAY[status] || status
  }

  const getStatusColor = (status) => {
    const colors = {
      [STATUS.ABERTO]: '#3b82f6',
      [STATUS.EM_ATENDIMENTO]: '#f59e0b',
      [STATUS.ENCERRADO]: '#10b981'
    }
    return colors[status] || '#6b7280'
  }

  return {
    isLoading,
    error,
    loadStatusFromBackend,
    getStatusDisplay,
    getStatusColor,
    STATUS,
    STATUS_DISPLAY,
    STATUS_VALUES,
    STATUS_OPTIONS
  }
}





