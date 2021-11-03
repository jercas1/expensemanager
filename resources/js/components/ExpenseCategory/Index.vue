<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">Expense Category</div>
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
                  v-for="(expense_category, index) in expense_categories"
                  :key="index"
                  @click="show(expense_category)"
                >
                  <th scope="row">{{ index + 1 }}</th>
                  <td>{{ expense_category.display_name }}</td>
                  <td>{{ expense_category.description }}</td>
                  <td>{{ expense_category.created_at | date }}</td>
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
      Add Expense Category
    </button>

    <div class="modal fade" id="roleFormModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ form.id ? "Update" : "Add" }} Expense Category</h5>
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
      expense_categories: [],

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
  },

  methods: {
    deleteConfirmation() {
      this.showDeleteConfirmation(this, this.form.display_name);
    },

    delete() {
      this.axios
        .delete(`/expense-category/delete/${this.form.id}`)
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

    show(expense_category) {
      this.form.id = expense_category.id;
      this.form.display_name = expense_category.display_name;
      this.form.description = expense_category.description;

      document.getElementById("roleModalButton").click();
    },

    save() {
      this.processForm(this);
      
      if (!this.form.id) {
        this.axios
          .post("/expense-category/store", this.form)
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
          .post(`/expense-category/update/${this.form.id}`, this.form)
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
        .get("/expense-category/get")
        .then((res) => {
          console.log(res);

          if (res.data.success) {
            this.expense_categories = res.data.expense_categories;
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