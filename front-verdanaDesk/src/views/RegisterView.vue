<script setup>
import { ref } from 'vue'
import { useAuth } from '@/composables/useAuth'

const { errorMessage, register, goToLogin } = useAuth()

const name = ref('')
const email = ref('')
const password = ref('')
const confirmPassword = ref('')
const successMessage = ref('')

async function handleRegisterSubmit(event) {
  event.preventDefault()
  successMessage.value = ''
  
  if (password.value !== confirmPassword.value) {
    errorMessage.value = 'Senhas não coincidem'
    return
  }
  
  const result = await register({ 
    name: name.value, 
    email: email.value, 
    password: password.value 
  })
  
  if (result.success) {
    successMessage.value = 'Conta criada com sucesso! Redirecionando...'
  }
}
</script>

<template>
  <div class="auth-page">
    <div class="auth-card">
      <div class="brand">
        <div class="logo">VD</div>
        <h1>Cadastrar usuário</h1>
        <p class="subtitle">Crie sua conta para começar</p>
      </div>

      <form class="auth-form" @submit="handleRegisterSubmit">
        <div v-if="errorMessage" class="alert">{{ errorMessage }}</div>
        <div v-if="successMessage" class="alert success">{{ successMessage }}</div>
        <label class="field">
          <span>Nome</span>
          <input v-model="name" type="text" placeholder="Seu nome" autocomplete="name" required />
        </label>

        <label class="field">
          <span>E-mail</span>
          <input v-model="email" type="email" placeholder="seu@email.com" autocomplete="email" required />
        </label>

        <label class="field">
          <span>Senha</span>
          <input v-model="password" type="password" placeholder="••••••••" autocomplete="new-password" required />
        </label>

        <label class="field">
          <span>Confirmar senha</span>
          <input v-model="confirmPassword" type="password" placeholder="••••••••" autocomplete="new-password" required />
        </label>

        <button class="btn primary" type="submit">Criar conta</button>
        <button class="btn ghost" type="button" @click="goToLogin">Voltar para login</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
/* Styles are now imported from external CSS files */
</style>


