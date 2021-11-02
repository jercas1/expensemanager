<template>
  <div>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header text-center bg-primary border-0">
              <h6 class="mb-0">Login</h6>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" v-model="form.email" />
                <div class="invalid-feedback d-block" v-if="error.email">
                  {{ error.email }}
                </div>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" v-model="form.password" />
                <div class="invalid-feedback d-block" v-if="error.password">
                  {{ error.password }}
                </div>
              </div>

              <vs-button
                class="w-100"
                :loading="loading"
                square
                @click="login()"
              >
                Login
              </vs-button>
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
      form: {
        email: "",
        password: "",
      },
      error: {
        email: "",
        password: "",
      },

      loading: false,
    };
  },

  methods: {
    login() {
      const vm = this;
      this.processForm(this);

      this.$store
        .dispatch("auth/login", this.form)
        .then((res) => {
          if (res.data.success) {
            this.$router.push({ name: `${res.data.user.type} Index` });

            this.$vs.notification({
              color: "success",
              title: "Logged In",
              text: "You have successfully logged in.",
            });
          }
        })
        .catch((err) => {
          console.log(err);

          this.processFormErrors(this, err);

          if (err.response.status == 400) {
            this.error.password = err.response.data.message;
          }
        })
        .finally(() => {
          vm.loading = false;
        });
    },
  },
};
</script>
