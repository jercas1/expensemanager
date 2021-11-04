<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">Users</div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email Address</th>
                  <th scope="col">Role</th>
                  <th scope="col">Created at</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(user, index) in users"
                  :key="index"
                  @click="show(user)"
                >
                  <th scope="row">{{ index + 1 }}</th>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.role_display_name }}</td>
                  <td>{{ user.created_at | date }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <button
      type="button"
      class="btn btn-primary mt-3 float-right"
      data-toggle="modal"
      data-target="#userFormModal"
      id="userModalButton"
      v-show="checkUserFunction(user_functions, module, 'store')"
    >
      Add User
    </button>

    <div
      class="modal fade"
      id="userFormModal"
      data-backdrop="static"
      data-keyboard="false"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ form.id ? "Update" : "Add" }} User</h5>
          </div>
          <div class="modal-body">
            <div class="container-fluid p-0">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      v-model="form.name"
                    />
                    <div class="invalid-feedback d-block" v-if="error.name">
                      {{ error.name }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      v-model="form.email"
                    />
                    <div class="invalid-feedback d-block" v-if="error.email">
                      {{ error.email }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select class="custom-select" v-model="form.role_id">
                      <option
                        :value="role.id"
                        v-for="(role, index) in roles"
                        :key="index"
                      >
                        {{ role.display_name }}
                      </option>
                    </select>
                    <div class="invalid-feedback d-block" v-if="error.role_id">
                      {{ error.role_id }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                      type="password"
                      class="form-control"
                      id="password"
                      v-model="form.password"
                    />
                    <div class="invalid-feedback d-block" v-if="error.password">
                      {{ error.password }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="password_confirmation" class="form-label"
                      >Confirm Password</label
                    >
                    <input
                      type="password"
                      class="form-control"
                      id="password_confirmation"
                      v-model="form.password_confirmation"
                    />
                    <div
                      class="invalid-feedback d-block"
                      v-if="error.password_confirmation"
                    >
                      {{ error.password_confirmation }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="display: block !important">
            <div class="d-flex">
              <div class="mr-auto p-2">
                <button
                  type="button"
                  class="btn btn-danger"
                  v-if="form.id"
                  @click="deleteConfirmation()"
                  :disabled="
                    !checkUserFunction(user_functions, module, 'delete')
                  "
                >
                  Delete
                </button>
              </div>
              <div class="p-2">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  id="cancelModalButton"
                  @click="reset()"
                >
                  Cancel
                </button>
              </div>
              <div class="p-2">
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="save()"
                  :disabled="
                    !checkUserFunction(
                      user_functions,
                      module,
                      form.id ? 'update' : 'store'
                    )
                  "
                >
                  {{ form.id ? "Update" : "Save" }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  data() {
    return {
      module: "User",

      users: [],
      roles: [],

      form: {
        id: null,
        name: null,
        email: null,
        role_id: null,
        password: "",
        password_confirmation: "",
      },
      error: {
        name: null,
        email: null,
        role_id: null,
        password: null,
        password_confirmation: null,
      },
    };
  },

  computed: {
    ...mapState("auth", ["user_functions"]),
  },

  created() {
    this.getRoles();
    this.get();
  },

  methods: {
    getRoles() {
      this.axios
        .get("/role/get")
        .then((res) => {
          console.log(res);

          if (res.data.success) {
            this.roles = res.data.roles;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    deleteConfirmation() {
      this.showDeleteConfirmation(this, this.form.email);
    },

    delete() {
      this.axios
        .delete(`/user/delete/${this.form.id}`)
        .then((res) => {
          if (res.data.success) {
            this.get();
            this.reset();

            this.$vs.notification({
              color: "success",
              title: res.data.title,
              text: res.data.message,
            });

            document.getElementById("cancelModalButton").click();
          } else {
            this.$vs.notification({
              color: "warning",
              title: res.data.title,
              text: res.data.message,
            });

            document.getElementById("cancelModalButton").click();
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    reset() {
      this.resetForm(this);
    },

    show(user) {
      this.form.id = user.id;
      this.form.name = user.name;
      this.form.email = user.email;
      this.form.role_id = user.role_id;

      document.getElementById("userModalButton").click();
    },

    save() {
      this.processForm(this);

      if (!this.form.id) {
        this.axios
          .post("/user/store", this.form)
          .then((res) => {
            if (res.data.success) {
              this.get();

              this.$vs.notification({
                color: "success",
                title: res.data.title,
                text: res.data.message,
              });

              document.getElementById("cancelModalButton").click();
            }
          })
          .catch((err) => {
            console.log(err);

            this.processFormErrors(this, err);
          });
      } else {
        this.axios
          .post(`/user/update/${this.form.id}`, this.form)
          .then((res) => {
            if (res.data.success) {
              this.get();

              this.$vs.notification({
                color: "success",
                title: res.data.title,
                text: res.data.message,
              });

              document.getElementById("cancelModalButton").click();
            } else {
              this.$vs.notification({
                color: "warning",
                title: res.data.title,
                text: res.data.message,
              });

              document.getElementById("cancelModalButton").click();
            }
          })
          .catch((err) => {
            console.log(err);

            this.processFormErrors(this, err);
          });
      }
    },

    get() {
      this.axios
        .get("/user/get")
        .then((res) => {
          console.log(res);

          if (res.data.success) {
            this.users = res.data.users;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style>
</style>