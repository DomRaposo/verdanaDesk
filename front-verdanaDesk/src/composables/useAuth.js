import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { api } from '@/services/api'

export function useAuth() {
  const router = useRouter()
  const errorMessage = ref('')

  const login = async (credentials) => {
    try {
      errorMessage.value = ''
      const result = await api.login(credentials)
      api.setAuthToken(result.token)
      router.push({ name: 'dashboard' })
      return { success: true }
    } catch (error) {
      errorMessage.value = error.message || 'Falha no login'
      return { success: false, error: errorMessage.value }
    }
  }

  const register = async (userData) => {
    try {
      errorMessage.value = ''
      await api.register(userData)
      router.push({ name: 'login' })
      return { success: true }
    } catch (error) {
      errorMessage.value = error.message || 'Falha no cadastro'
      return { success: false, error: errorMessage.value }
    }
  }

  const logout = () => {
    api.setAuthToken('')
    router.push({ name: 'login' })
  }

  const goToRegister = () => {
    router.push({ name: 'register' })
  }

  const goToLogin = () => {
    router.push({ name: 'login' })
  }

  return {
    errorMessage,
    login,
    register,
    logout,
    goToRegister,
    goToLogin
  }
}
