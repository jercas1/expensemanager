import store from "./store/index";

const created = () => {
  const userInfo = localStorage.getItem('user')
  if (userInfo) {
    const userData = JSON.parse(userInfo);
    store.commit("auth/setUser", userData);
    store.dispatch("auth/getAuth");
    store.dispatch("auth/getAuthRoleFunction");
  }
}

export default created