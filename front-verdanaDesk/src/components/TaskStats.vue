<script setup>
defineProps({
  stats: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <div class="stats-grid">
    <div class="stat-card">
      <h3>Total</h3>
      <p class="stat-number">{{ stats.total }}</p>
    </div>
    <div class="stat-card">
      <h3>Em Aberto</h3>
      <p class="stat-number">{{ stats.open }}</p>
    </div>
    <div class="stat-card">
      <h3>Fechados</h3>
      <p class="stat-number">{{ stats.closed }}</p>
    </div>
  </div>
</template>
