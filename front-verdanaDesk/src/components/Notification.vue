<script setup>
defineProps({
  notification: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <div 
    v-if="notification.show" 
    class="notification"
    :class="`notification-${notification.type}`"
  >
    {{ notification.message }}
  </div>
</template>
