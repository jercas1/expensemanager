<template>
  <div>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-4">
          <div class="card">
            <div class="card-header text-center bg-primary border-0">
              <h6 class="mb-0">Login</h6>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  v-model="form.email"
                />
                <div class="invalid-feedback d-block" v-if="error.email">
                  {{ error.email }}
                </div>
              </div>

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

        <div class="col">
          <strong class="mb-2">From the programmer:</strong>
          <p>
            Hello, I am Jerry, the examiner of this project. I have created two
            versions for the role module which can be found in the following
            branches.
          </p>
          <ul>
            <li><strong>main</strong> branch</li>
            <li><strong>rolerevision</strong> branch</li>
          </ul>
          <p>
            The <strong>main</strong> branch follows the role module as the
            instruction say (or so I thought) and the the
            <strong>rolerevision</strong> branch where the superadmin can select
            only which functions can be used for a certain role.
          </p>

          <p>Please check out my rolerevision version :)</p>

          <p>You can try the rolerevision version by switching branch to <strong>rolerevision</strong>. Make sure to run <strong>npm run dev/prod</strong> after switching branch to compile the frontend.</p>

          <p>
            Also, before using the system, make sure to run the seeder. You can
            run it with the command
          </p>
          <p><strong>php artisan db:seed</strong></p>

          <strong>Users Credentials:</strong>
          <ul>
            <li>
              Email: <strong>admin@gmail.com</strong> Password:
              <strong>password</strong>
            </li>
            <li>
              Email: <strong>user1@gmail.com</strong> Password:
              <strong>password</strong>
            </li>
          </ul>

          <p>
            Should you have any problem regarding the project, you can contact
            me through my email,
            <strong>jerryconstantinecastro@gmail.com</strong> or my contact
            number, <strong>0920 836 2220</strong>
          </p>
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
            this.$router.push({ name: "Dashboard" });

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
