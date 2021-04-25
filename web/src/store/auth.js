import axios from 'axios'

export default {
    namespaced: true,

    state: {
        authenticated: false,
        user: null
    },

    getters: {
        authenticated (state) {
            return state.authenticated
        },

        user (state) {
            return state.user
        },
    },

    mutations: {
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },

        SET_USER (state, value) {
            state.user = value
        }
    },

    actions: {
        async signIn ({ dispatch }, credentials) {
            await axios.get(process.env.VUE_APP_API_URL+'/sanctum/csrf-cookie')
            await axios.post(process.env.VUE_APP_API_URL+'/login', credentials)

            return dispatch('me')
        },

        async signOut ({ dispatch }) {
            await axios.post(process.env.VUE_APP_API_URL+'/logout')

            return dispatch('me')
        },

        me ({ commit }) {
            return axios.get(process.env.VUE_APP_API_URL+'/api/user').then((response) => {
                commit('SET_AUTHENTICATED', true)
                commit('SET_USER', response.data)
            }).catch(() => {
                commit('SET_AUTHENTICATED', false)
                commit('SET_USER', null)
            })
        }
    }
}