import * as API from "./API.js";

export default {
    login(payload) {
        return API.apiClient.post("/login", payload);
    },
    logout() {
        return API.apiClient.post("/logout");
    }
};