import axios from "../../api";

const setUser = (state, payload) => {
    state.user = payload.user;

    // Save user data to local storage to remember user credentials
    localStorage.setItem("user", JSON.stringify(payload));
    axios.defaults.headers.common.Authorization = `Bearer ${payload.token}`;
};

const clearUser = () => {
    localStorage.removeItem("user");
    location.reload();
};

const updateUser = (state, payload) => {
    state.user = payload.user;

    let user = JSON.parse(localStorage.getItem("user"));
    user.user = payload.user;
    localStorage.setItem("user", JSON.stringify(user));
};

const setUserFunctions = (state, payload) => {
    state.user_functions = payload.user_functions;
};

export default {
    setUser,
    clearUser,
    updateUser,
    setUserFunctions,
};
