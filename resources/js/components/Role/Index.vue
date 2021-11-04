<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">Roles</div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Display Name</th>
                  <th scope="col">Description</th>
                  <th scope="col">Created at</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(role, index) in roles"
                  :key="index"
                  @click="show(role)"
                >
                  <th scope="row">{{ index + 1 }}</th>
                  <td>{{ role.display_name }}</td>
                  <td>{{ role.description }}</td>
                  <td>{{ role.created_at | date }}</td>
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
      data-target="#roleFormModal"
      id="roleModalButton"
    >
      Add Role
    </button>

    <div
      class="modal fade"
      id="roleFormModal"
      data-backdrop="static"
      data-keyboard="false"
    >
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ form.id ? "Update" : "Add" }} Role</h5>
          </div>
          <div class="modal-body">
            <div class="container-fluid p-0">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="display_name" class="form-label"
                      >Display Name</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="display_name"
                      v-model="form.display_name"
                    />
                    <div
                      class="invalid-feedback d-block"
                      v-if="error.display_name"
                    >
                      {{ error.display_name }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="description" class="form-label"
                      >Description</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="description"
                      v-model="form.description"
                    />
                    <div
                      class="invalid-feedback d-block"
                      v-if="error.description"
                    >
                      {{ error.description }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div
                  class="col-3 mb-4"
                  v-for="(module, index) in role_function_modules"
                  :key="index"
                >
                  <div class="card">
                    <div class="card-header">
                      {{ module }}
                    </div>
                    <div class="card-body">
                      <div
                        class="row"
                        v-for="(rfunction, index) in role_functions.filter(
                          (rf) => rf.module === module
                        )"
                        :key="index"
                      >
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              class="custom-control-input"
                              :id="`rfunction${rfunction.id}`"
                              v-model="rfunction.active"
                            />
                            <label
                              class="custom-control-label"
                              :for="`rfunction${rfunction.id}`"
                              >{{ rfunction.display_name }}</label
                            >
                          </div>
                        </div>
                      </div>
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
                <button type="button" class="btn btn-primary" @click="save()">
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
export default {
  data() {
    return {
      roles: [],
      role_functions: [],
      role_function_modules: [],

      form: {
        id: null,
        display_name: null,
        description: null,
      },
      error: {
        display_name: null,
        description: null,
      },
    };
  },

  created() {
    this.get();
    this.getRoleFunction();
  },

  methods: {    
    getRoleFunction() {
      this.axios
        .get("/role/get-role-function")
        .then((res) => {
          console.log(res);

          if (res.data.success) {
            this.role_functions = res.data.role_functions;
            this.role_functions.forEach((element) => {
              element.active = false;
            });

            let modules = res.data.role_functions.map(
              (element) => element.module
            );
            this.role_function_modules = [...new Set(modules)];
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    deleteConfirmation() {
      this.showDeleteConfirmation(this, this.form.display_name);
    },

    delete() {
      this.axios
        .delete(`/role/delete/${this.form.id}`)
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

      this.role_functions.forEach((element) => {
        element.active = false;
        document.getElementById(`rfunction${element.id}`).checked = false;
      });
    },

    show(role) {
      this.form.id = role.id;
      this.form.display_name = role.display_name;
      this.form.description = role.description;

      role.role_details.forEach((element) => {
        this.role_functions.find(
          (rfunction) => rfunction.id === element.role_function_id
        ).active = true;

        document.getElementById(`rfunction${element.role_function_id}`).checked = true;
      });

      document.getElementById("roleModalButton").click();
    },

    save() {
      this.processForm(this);

      let form = Object.assign({}, this.form);
      form.role_details = this.role_functions
        .filter((rfunction) => rfunction.active)
        .map((rfunction) => rfunction.id);

      if (!this.form.id) {
        this.axios
          .post("/role/store", form)
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
          .post(`/role/update/${this.form.id}`, form)
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
  },
};
</script>

<style>
</style>