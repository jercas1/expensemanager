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
      active: "Udf",
      activeSidebar: false,
    };
  },

  computed: {
    ...mapState("auth", ["user"]),
  },

  methods: {
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
