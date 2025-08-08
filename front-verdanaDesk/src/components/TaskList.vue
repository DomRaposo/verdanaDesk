<script setup>
import TaskCard from './TaskCard.vue'

defineProps({
  tasks: {
    type: Array,
    required: true
  },
  loading: {
    type: Boolean,
    default: false
  },
  deletingTasks: {
    type: Set,
    default: () => new Set()
  }
})

const emit = defineEmits(['edit', 'close', 'delete', 'create'])
</script>

<template>
  <div class="tasks-section">
    <h2>Chamados</h2>
    
    <div v-if="loading" class="loading">
      <p>Carregando chamados...</p>
    </div>

    <div v-else-if="tasks.length === 0" class="empty-state">
      <p>Nenhum chamado encontrado.</p>
      <button @click="emit('create')" class="btn btn-primary">
        Criar primeiro chamado
      </button>
    </div>

    <div v-else class="tasks-grid">
      <TaskCard
        v-for="task in tasks"
        :key="task.id"
        :task="task"
        :is-deleting="deletingTasks.has(task.id)"
        @edit="emit('edit', $event)"
        @close="emit('close', $event)"
        @delete="emit('delete', $event)"
      />
    </div>
  </div>
</template>
