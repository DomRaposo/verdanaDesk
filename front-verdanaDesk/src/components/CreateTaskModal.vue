<template>
  <div v-if="show" class="modal-overlay" @click="$emit('close')">
    <div class="modal" @click.stop>
      <div class="modal-header">
        <h3>Novo Chamado</h3>
        <button @click="$emit('close')" class="modal-close">&times;</button>
      </div>
      <form @submit.prevent="handleSubmit" class="modal-form">
        <div class="form-group">
          <label>Título</label>
          <input v-model="formData.title" type="text" required :disabled="loading" />
        </div>
        <div class="form-group">
          <label>Descrição</label>
          <textarea v-model="formData.description" rows="3" required :disabled="loading"></textarea>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select v-model="formData.status" :disabled="loading">
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
          <button type="button" @click="$emit('close')" class="btn btn-secondary" :disabled="loading">
            Cancelar
          </button>
          <button type="submit" class="btn btn-primary" :disabled="loading">
            <span v-if="loading">Criando...</span>
            <span v-else>Criar</span>
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
  loading: {
    type: Boolean,
    default: false
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

// Reset form when modal opens
watch(() => props.show, (newValue) => {
  if (newValue) {
    formData.value = {
      title: '',
      description: '',
      status: STATUS.ABERTO
    }
  }
})

function handleSubmit() {
  if (!props.loading) {
    emit('submit', { ...formData.value })
  }
}
</script>

<style scoped>
/* Styles are imported from external CSS files */
</style>
