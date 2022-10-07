<template>
  <div>
    <!-- Alert -->
    <alert-message :dialog="snackbar"></alert-message>
    <template>
      <app-layout></app-layout>
    </template>
  </div>
</template>

<script>
import AppLayout from "@/layouts/AppLayout";
import { EventBus } from "@/event-bus";
import { mapGetters } from "vuex";
import DEFINES from "@/defines";
import AlertMessage from "@/components/dialogBox/AlertMessage";

export default {
  name: "app",
  components: {
    AppLayout,
    AlertMessage
  },
  data() {
    return {
      loader: false,
      snackbar: {
        show: false,
        text: "",
        color: ""
      },
      reminderMessageDialog: {
        show: false,
        error: null
      },
      appLayout: DEFINES.LAYOUT_APP
    };
  },

  computed: {
    ...mapGetters("app", {
      layout: "appLayout"
    })
  },
  created() {
    EventBus.$on("showMessage", payload => {
      this.snackbar = {
        show: true,
        color: payload.color,
        text: payload.message
      };
    });
    EventBus.$on("showLoader", payload => {
      this.loader = true;
    });
    EventBus.$on("hideLoader", payload => {
      this.loader = false;
    });
  },
};
</script>
<style scoped>
 >>> .v-dialog {
box-shadow: none !important;
}
>>> .v-snack--bottom {
  position: inherit;
  display: inline;
}
</style>
