<template>
  <v-dialog v-if="dialog.show" v-model="dialog.show" width="500">
    <v-card>
      <v-card-title :class="dialog.color" class="white--text">
        <div class="title">
          <v-icon color="white">{{
            dialog.color == "error"
              ? "$vuetify.icons.sad"
              : "$vuetify.icons.happy"
          }}</v-icon>
          <span v-if="dialog.color == 'error'">Error</span>
          <span v-else>Success</span>
        </div>
        <v-spacer></v-spacer>
        <v-icon small class="white--text" @click="dialog.show = false"
          >$vuetify.icons.close</v-icon
        >
      </v-card-title>
      <v-card-text
        class="subheading py-4 text-xs-center"
        v-html="dialog.text"
        ></v-card-text
      >
      <v-divider></v-divider>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="grey" dark flat outline @click="dialog.show = false">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "AlertMessage",
  props: {
    dialog: {}
  }
};
</script>

<style>
</style>
