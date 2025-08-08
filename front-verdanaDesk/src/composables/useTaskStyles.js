export function useTaskStyles() {
  const priorityColors = {
    low: '#10b981',
    medium: '#f59e0b',
    high: '#ef4444'
  }

  const statusColors = {
    open: '#3b82f6',
    in_progress: '#f59e0b',
    closed: '#10b981'
  }

  const getPriorityLabel = (priority) => {
    const labels = {
      low: 'Baixa',
      medium: 'Média',
      high: 'Alta'
    }
    return labels[priority] || 'Média'
  }

  const getStatusLabel = (status) => {
    const labels = {
      open: 'Aberto',
      in_progress: 'Em Progresso',
      closed: 'Fechado'
    }
    return labels[status] || 'Aberto'
  }

  return {
    priorityColors,
    statusColors,
    getPriorityLabel,
    getStatusLabel
  }
}
