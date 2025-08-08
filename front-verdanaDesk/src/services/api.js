const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000/api'

function getAuthToken() {
  return localStorage.getItem('auth_token') || ''
}

function setAuthToken(token) {
  if (token) {
    localStorage.setItem('auth_token', token)
  } else {
    localStorage.removeItem('auth_token')
  }
}

async function request(path, options = {}) {
  const headers = new Headers(options.headers || {})
  headers.set('Content-Type', 'application/json')

  const token = getAuthToken()
  if (token) headers.set('Authorization', `Bearer ${token}`)

  const response = await fetch(`${API_BASE_URL}${path}`, {
    ...options,
    headers,
  })

  const isJson = response.headers.get('content-type')?.includes('application/json')
  const data = isJson ? await response.json() : null

  if (!response.ok) {
    const message = data?.message || `Erro ${response.status}`
    throw new Error(message)
  }

  return data
}

export const api = {
  login: (payload) => request('/login', { method: 'POST', body: JSON.stringify(payload) }),
  register: (payload) => request('/users', { method: 'POST', body: JSON.stringify(payload) }),
  logout: () => request('/logout', { method: 'POST' }),
  // Tasks API
  getTasks: () => request('/tasks'),
  createTask: (payload) => request('/tasks/create', { method: 'POST', body: JSON.stringify(payload) }),
  updateTask: (id, payload) => request(`/tasks/${id}`, { method: 'PUT', body: JSON.stringify(payload) }),
  deleteTask: (id) => request(`/tasks/${id}`, { method: 'DELETE' }),
  closeTask: (id) => request(`/tasks/${id}/close`, { method: 'POST' }),
  getStatusOptions: () => request('/tasks/status-options'),
  setAuthToken,
  getAuthToken,
}



