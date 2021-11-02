const add = (state, payload) => {
  state.roles.unshift(payload.role);

  state.role = payload.role;
}

const setList = (state, payload) => {
  state.roles = state.roles.concat(payload.roles);
}

const set = (state, payload) => {
  state.role = payload.role;
}

const update = (state, payload) => {
  const role_index = state.roles.findIndex(role => role.original_id == payload.role.original_id);

  if (role_index >= 0) {
    Object.assign(
      state.roles[role_index],
      payload.role
    );
  }
  
  state.role = payload.role;
}

const remove = (state, payload) => {
  const role_index = state.roles.findIndex(role => role.original_id == payload.original_id);

  if (role_index >= 0) {
    state.roles.splice(
      state.roles.findIndex((role) => role.original_id === payload.original_id),
      1
    );
  }
  
  state.role = null;
}

const removeList = (state) => {
  state.roles = [];
}

export default {
  set,
  setList,
  add,
  update,
  remove,
  removeList,
}