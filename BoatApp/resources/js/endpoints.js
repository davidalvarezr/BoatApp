const prefix = '/api'

const endpoints = {
    'api-boat-store': {
        method: 'POST',
        route: buildUrl('/boat')
    },
    'api-boat-update': {
        method: 'PUT',
        route: (id) => buildUrl(`/boat/${id}`)
    },
    'api-boat-delete': {
        method: 'DELETE',
        route: (id) => buildUrl(`/boat/${id}`)
    },
}

function buildUrl(route) {
    return prefix + route
}

export default endpoints
