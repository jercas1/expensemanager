<template>
  <div>
    <div v-if="user">
      <vs-navbar shadow square center-collapsed v-model="active">
        <template #left>
          <vs-button @click="activeSidebar = !activeSidebar" flat icon>
            <box-icon name="menu"></box-icon>
          </vs-button>
        </template>
      </vs-navbar>
      <vs-sidebar absolute v-model="active" :open.sync="activeSidebar">
        <div @click="pushRouter('Dashboard')">
          <vs-sidebar-item id="Dashboard"> Dashboard </vs-sidebar-item>
        </div>

        <vs-sidebar-group>
          <template #header>
            <vs-sidebar-item arrow> User Management </vs-sidebar-item>
          </template>

          <div @click="pushRouter('Role')" v-if="checkUserFunction('Role')">
            <vs-sidebar-item id="Role"> Roles </vs-sidebar-item>
          </div>
          <div @click="pushRouter('User')" v-if="checkUserFunction('User')">
            <vs-sidebar-item id="User"> User </vs-sidebar-item>
          </div>
        </vs-sidebar-group>

        <vs-sidebar-group>
          <template #header>
            <vs-sidebar-item arrow> Expense Management </vs-sidebar-item>
          </template>

          <div @click="pushRouter('Expense Category')">
            <vs-sidebar-item
              id="Expense Category"
              v-if="checkUserFunction('Expense Category')"
            >
              Expense Categories
            </vs-sidebar-item>
          </div>
          <div
            @click="pushRouter('Expense')"
            v-if="checkUserFunction('Expense')"
          >
            <vs-sidebar-item id="Expense"> Expenses </vs-sidebar-item>
          </div>
        </vs-sidebar-group>

        <template #footer>
          <div @click="logout()">
            <vs-sidebar-item>Logout</vs-sidebar-item>
          </div>
        </template>
      </vs-sidebar>
    </div>

    <router-view class="mt-5 mb-2" />
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  data() {
    return {
      active: "Dashboard",
      activeSidebar: false,
    };
  },

  computed: {
    ...mapState("auth", ["user", "user_functions"]),
  },

  methods: {
    checkUserFunction(module) {
      return this.user_functions.findIndex(
        (ufunction) => ufunction.module === module
      ) >= 0
        ? true
        : false;
    },

    pushRouter(route_name) {
      if (this.$route.name != route_name) {
        this.activeSidebar = false;
        this.$router.push({
          name: route_name,
        });
      }
    },

    logout() {
      this.$store.dispatch("auth/logout");
    },
  },
};
</script>
