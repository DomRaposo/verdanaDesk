<script setup>
defineEmits(['create', 'logout'])
</script>

<template>
  <header class="header">
    <div class="header-content">
      <h1>Dashboard de Chamados</h1>
      <div class="header-actions">
        <button @click="$emit('create')" class="btn btn-primary">
          + Novo Chamado
        </button>
        <button @click="$emit('logout')" class="btn btn-secondary">
          Sair
        </button>
      </div>
    </div>
  </header>
</template>
