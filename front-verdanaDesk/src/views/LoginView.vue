<script setup>
import { ref } from 'vue'
import { useAuth } from '@/composables/useAuth'

const { errorMessage, login, goToRegister } = useAuth()

const email = ref('')
const password = ref('')

async function handleLoginSubmit(event) {
  event.preventDefault()
  await login({ email: email.value, password: password.value })
}
</script>

<template>
  <div class="auth-page">
    <div class="auth-card">
      <div class="brand">
        <div class="logo">VD</div>
        <h1>Entrar</h1>
        <p class="subtitle">Acesse sua conta para continuar</p>
      </div>

      <form class="auth-form" @submit="handleLoginSubmit">
        <div v-if="errorMessage" class="alert">{{ errorMessage }}</div>
        <label class="field">
          <span>E-mail</span>
          <input
            v-model="email"
            type="email"
            placeholder="seu@email.com"
            autocomplete="email"
            required
          />
        </label>

        <label class="field">
          <span>Senha</span>
          <input
            v-model="password"
            type="password"
            placeholder="••••••••"
            autocomplete="current-password"
            required
          />
        </label>

        <button class="btn primary" type="submit">Entrar</button>
        <button class="btn ghost" type="button" @click="goToRegister">Cadastrar usuário</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
/* Styles are now imported from external CSS files */
</style>


