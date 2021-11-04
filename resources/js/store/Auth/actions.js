import axios from "../../api";

const login = async (context, payload) => {
    return new Promise((resolve, reject) => {
        axios
            .post("/auth/login", payload)
            .then((res) => {
                if (res.data.success) {
                    context.commit("setUser", {
                        user: res.data.user,
                        token: res.data.token,
                    });
                }

                resolve(res);
            })
            .catch((err) => {
                reject(err);
            });
    });
};

const logout = (context, payload) => {
    axios
        .post("/auth/logout", payload)
        .then((res) => {
            res;
        })
        .catch((err) => {
            console.log(err);
        })
        .finally(() => {
            context.commit("clearUser");
        });
};

const updateAuth = (context, payload) => {
    return new Promise((resolve, reject) => {
        axios
            .put(`/auth/update-auth`, payload)
            .then((res) => {
                context.commit("updateUser", {
                    user: payload,
                });
                resolve(res);
            })
            .catch((err) => {
                reject(err);
            });
    });
};

const getAuth = (context) => {
    return new Promise((resolve, reject) => {
        axios
            .get("/auth/get-auth")
            .then((res) => {
                context.commit("updateUser", {
                    user: res.data.user,
                });
                resolve(res);
            })
            .catch((err) => {
                reject(err);
            });
    });
};

const getAuthRoleFunction = (context) => {
    return new Promise((resolve, reject) => {
        axios
            .get("/role/get-auth-role-function")
            .then((res) => {
                if (res.data.success) {
                    context.commit("setUserFunctions", {
                        user_functions: res.data.user_functions,
                    });
                }
            })
            .catch((err) => {
                console.log(err);
            });
    });
};

export default {
    login,
    logout,
    updateAuth,
    getAuth,
    getAuthRoleFunction,
};
