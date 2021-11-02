// Equivalent to data in vue
import state from "./state"
// Equivalent to  computed in vue
import getters from "./getters"
// Actions are for asynchronous functions like axios requests
// Good for commiting a mutation after an asynchronous function
import actions from "./actions"
// Mutations are for making difference in state
import mutations from "./mutations"

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
