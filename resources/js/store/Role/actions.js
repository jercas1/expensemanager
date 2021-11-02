import axios from '../../api';

const store = (context, payload) => {
  return new Promise((resolve, reject) => {
    axios.post("/role/store", payload)
      .then(res => {
        if (res.data.success) {
          context.commit('add', {
            role: res.data.role
          });
        }

        resolve(res);
      })
      .catch(err => {
        reject(err);
      });
  });
}

const get = (context, payload) => {
  return new Promise((resolve, reject) => {
    axios.get(`/role/get`)
      .then(res => {
        if (res.data.success) {
          context.commit('setList', {
            roles: res.data.roles.data,
            page: payload,
          });
        }

        resolve(res);
      })
      .catch(err => {
        reject(err);
      });
  });
}

const find = (context, payload) => {
  return new Promise((resolve, reject) => {
    axios.get(`/role/find/${payload}`)
      .then(res => {
        resolve(res);
      })
      .catch(err => {
        reject(err);
      });
  });
}

const update = (context, payload) => {
  return new Promise((resolve, reject) => {
    axios.post(`/role/update/${payload.original_id}`, payload)
      .then(res => {
        resolve(res);
      })
      .catch(err => {
        reject(err);
      });
  });
}

const remove = (context, payload) => {
  return new Promise((resolve, reject) => {
    axios.delete(`/role/delete/${payload}`)
      .then(res => {
        resolve(res);
      })
      .catch(err => {
        reject(err);
      });
  });
}

export default {
  store,
  get,
  find,
  update,
  remove,
}