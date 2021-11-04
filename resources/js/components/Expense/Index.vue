<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">Expenses</div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Expense Category</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Entry Date</th>
                  <th scope="col">Created at</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(expense, index) in expenses"
                  :key="index"
                  @click="show(expense)"
                >
                  <th scope="row">{{ index + 1 }}</th>
                  <td>{{ expense.expense_category_display_name }}</td>
                  <td>{{ expense.amount }}</td>
                  <td>{{ expense.entry_date }}</td>
                  <td>{{ expense.created_at | date }}</td>
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
      data-target="#expenseFormModal"
      id="expenseModalButton"
      v-show="checkUserFunction(user_functions, module, 'store')"
    >
      Add Expense
    </button>

    <div
      class="modal fade"
      id="expenseFormModal"
      data-backdrop="static"
      data-keyboard="false"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              {{ form.id ? "Update" : "Add" }} Expense
            </h5>
          </div>
          <div class="modal-body">
            <div class="container-fluid p-0">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="expense_category_id" class="form-label"
                      >Expense Category</label
                    >
                    <select
                      class="custom-select"
                      v-model="form.expense_category_id"
                    >
                      <option
                        :value="expense_category.id"
                        v-for="(expense_category, index) in expense_categories"
                        :key="index"
                      >
                        {{ expense_category.display_name }}
                      </option>
                    </select>
                    <div
                      class="invalid-feedback d-block"
                      v-if="error.expense_category_id"
                    >
                      {{ error.expense_category_id }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input
                      type="number"
                      class="form-control"
                      id="amount"
                      v-model="form.amount"
                    />
                    <div class="invalid-feedback d-block" v-if="error.amount">
                      {{ error.amount }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="entry_date" class="form-label"
                      >Entry Date</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      id="entry_date"
                      v-model="form.entry_date"
                    />
                    <div
                      class="invalid-feedback d-block"
                      v-if="error.entry_date"
                    >
                      {{ error.entry_date }}
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
      module: "Expense",

      expenses: [],
      expense_categories: [],

      form: {
        id: null,
        expense_category_id: null,
        amount: null,
        entry_date: null,
      },
      error: {
        expense_category_id: null,
        amount: null,
        entry_date: null,
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

    deleteConfirmation() {
      this.showDeleteConfirmation(this, "expense");
    },

    delete() {
      this.axios
        .delete(`/expense/delete/${this.form.id}`)
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

    show(expense) {
      this.form.id = expense.id;
      this.form.expense_category_id = expense.expense_category_id;
      this.form.amount = expense.amount;
      this.form.entry_date = expense.entry_date;

      document.getElementById("expenseModalButton").click();
    },

    save() {
      this.processForm(this);

      if (!this.form.id) {
        this.axios
          .post("/expense/store", this.form)
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
          .post(`/expense/update/${this.form.id}`, this.form)
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
        .get("/expense/get")
        .then((res) => {
          console.log(res);

          if (res.data.success) {
            this.expenses = res.data.expenses;
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