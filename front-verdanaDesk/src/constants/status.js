// Status constants - will be populated from backend
export const STATUS = {
  ABERTO: 'ABERTO',
  EM_ATENDIMENTO: 'EM_ATENDIMENTO',
  ENCERRADO: 'ENCERRADO'
}

// Status display names - will be populated from backend
export const STATUS_DISPLAY = {
  [STATUS.ABERTO]: 'Aberto',
  [STATUS.EM_ATENDIMENTO]: 'Em Atendimento',
  [STATUS.ENCERRADO]: 'Encerrado'
}

// Status colors
export const STATUS_COLORS = {
  [STATUS.ABERTO]: '#3b82f6',
  [STATUS.EM_ATENDIMENTO]: '#f59e0b',
  [STATUS.ENCERRADO]: '#10b981'
}

// Get all status values - will be populated from backend
export const STATUS_VALUES = Object.values(STATUS)

// Get status options for select - will be populated from backend
export const STATUS_OPTIONS = STATUS_VALUES.map(value => ({
  value,
  label: STATUS_DISPLAY[value]
}))

// Function to update status constants from backend data
export function updateStatusFromBackend(backendData) {
  if (backendData && backendData.status_options) {
    // Update STATUS object
    backendData.status_options.forEach(status => {
      STATUS[status] = status
    })
    
    // Update STATUS_DISPLAY object
    if (backendData.status_cases) {
      backendData.status_cases.forEach(statusCase => {
        STATUS_DISPLAY[statusCase.value] = statusCase.label
      })
    }
    
    // Update STATUS_VALUES
    STATUS_VALUES.length = 0
    STATUS_VALUES.push(...backendData.status_options)
    
    // Update STATUS_OPTIONS
    STATUS_OPTIONS.length = 0
    STATUS_OPTIONS.push(...STATUS_VALUES.map(value => ({
      value,
      label: STATUS_DISPLAY[value] || value
    })))
  }
}
