<template>
  <div v-if="show" class="modal-overlay" @click="$emit('close')">
    <div class="modal" @click.stop>
      <div class="modal-header">
        <h3>Editar Chamado</h3>
        <button @click="$emit('close')" class="modal-close">&times;</button>
      </div>
      <form @submit.prevent="handleSubmit" class="modal-form">
        <div class="form-group">
          <label>Título</label>
          <input v-model="formData.title" type="text" required />
        </div>
        <div class="form-group">
          <label>Descrição</label>
          <textarea v-model="formData.description" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select v-model="formData.status">
            <option 
              v-for="option in STATUS_OPTIONS" 
              :key="option.value" 
              :value="option.value"
            >
              {{ option.label }}
            </option>
          </select>
        </div>
        <div class="modal-actions">
          <button type="button" @click="$emit('close')" class="btn btn-secondary">
            Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
            Salvar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useStatus } from '@/composables/useStatus'

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  task: {
    type: Object,
    default: null
  }
})

const emit = defineEmits(['close', 'submit'])

// Use status composable
const { STATUS, STATUS_OPTIONS } = useStatus()

const formData = ref({
  title: '',
  description: '',
  status: STATUS.ABERTO
})

// Update form data when task changes
watch(() => props.task, (newTask) => {
  if (newTask) {
    formData.value = {
      title: newTask.title,
      description: newTask.description,
      status: newTask.status
    }
  }
}, { immediate: true })

function handleSubmit() {
  emit('submit', { ...formData.value })
}
</script>

<style scoped>
/* Styles are imported from external CSS files */
</style>
