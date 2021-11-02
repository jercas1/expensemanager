require("./bootstrap");

import Vue from "vue";
import App from "./App.vue";

import created from "./created";
import "./filters";
import "./mixins/index";
import router from "./router";
import store from "./store";

import Vuesax from "vuesax";
import "vuesax/dist/vuesax.css"; //Vuesax styles
Vue.use(Vuesax, {
    // options here
});

import "boxicons";

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
Vue.use(VueSweetalert2);

Vue.config.productionTip = false;

new Vue({
    created: created,
    router,
    store,
    render: (h) => h(App),
}).$mount("#app");
