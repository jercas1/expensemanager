import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import routes from "./routes";

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem("user");
    const user = JSON.parse(loggedIn);

    if (loggedIn && to.matched.some((route) => route.meta.auth)) {
        if (user.user.role_id === 1) {
            next();
        } else {
            if (!to.matched.some((route) => route.meta.admin)) {
                next();
            } else {
                next({ name: "Dashboard" });
            }
        }
    } else if (loggedIn) {
        if (to.name && to.name != "Login") {
            next();
        } else {
            next({ name: "Main" });
        }
    } else if (to.name === "Login") {
        next();
    } else {
        next({ name: "Login" });
    }
});

export default router;
