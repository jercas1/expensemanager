import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

import store from "./store/index";

const base = axios.create({
  baseURL: 'api'
});

base.interceptors.response.use(
  response => response,
  error => {
    if (error.response.status === 401) {
      store.dispatch("auth/logout");
    } else if (error.response.status === 403) {
      Vue.prototype.$vs.notification({
        color: "danger",
        title: error.response.data.title,
        text: error.response.data.message,
      });
    } else if (error.response.status === 500) {
      Vue.prototype.$vs.notification({
        duration: "none",
        color: "danger",
        title: error.response.statusText,
        text: error.response.data.message,
      });
    }
    return Promise.reject(error);
  }
);

Vue.use(VueAxios, base)

export default base
