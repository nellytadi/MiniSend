import AuthService from "../../services/AuthService";

export const namespaced = true;

export const state = {
    user: null,
    token: window.localStorage.getItem("token"),
    error: null
};

export const mutations = {

    CLEAR_USER() {
        window.localStorage.clear();
        location.reload();
    },
    SET_TOKEN(state, token) {
        state.token = token;
        window.localStorage.setItem("token", token);
    },
    SET_ERROR(state, error) {
        state.error = error;
    }
};

export const actions = {
    login({ commit }, payload) {

        return AuthService.login(payload)
            .then(response => {
                commit("SET_TOKEN", response.data.access_token);
            })
            .catch(error => {
                commit("SET_ERROR", error.data ? error.data.message : error);
            });
    },
    logout({ commit }) {
        return AuthService.logout()
            .then(() => {
                commit("CLEAR_USER");
            })
            .catch(() => {
                commit("CLEAR_USER");
            });
    }
};

export const getters = {
    authUser: state => {
        return state.user;
    },
    error: state => {
        return state.error;
    },
    loggedIn: state => {
        return !!state.token;
    }

};