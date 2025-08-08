<script setup>
import { useTaskStyles } from '@/composables/useTaskStyles'

const props = defineProps({
  task: {
    type: Object,
    required: true
  },
  isDeleting: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['edit', 'close', 'delete'])

const { priorityColors, statusColors, getPriorityLabel, getStatusLabel } = useTaskStyles()

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('pt-BR')
}
</script>

<template>
  <div 
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
          {{ getPriorityLabel(task.priority) }}
        </span>
        <span 
          class="badge status" 
          :style="{ backgroundColor: statusColors[task.status] }"
        >
          {{ getStatusLabel(task.status) }}
        </span>
      </div>
    </div>
    
    <p class="task-description">{{ task.description }}</p>
    
    <div class="task-footer">
      <div class="task-actions">
        <button @click="emit('edit', task)" class="btn btn-small">
          Editar
        </button>
        <button 
          v-if="task.status !== 'closed'" 
          @click="emit('close', task.id)" 
          class="btn btn-small btn-success"
        >
          Fechar
        </button>
        <button 
          @click="emit('delete', task.id)" 
          class="btn btn-small btn-danger"
          :disabled="isDeleting"
        >
          {{ isDeleting ? 'Excluindo...' : 'Excluir' }}
        </button>
      </div>
      <small class="task-date">
        Criado em {{ formatDate(task.created_at) }}
      </small>
    </div>
  </div>
</template>
