<template>
  <v-dialog :value="dialog" width="700" persistent>
    <v-card>
      <v-card-title class="title greyDarken3--text">
        Please confirm
      </v-card-title>
      <v-divider/>
      <v-card-text class="title">
        {{
          text != undefined ? text : "Are you sure you want to continue?"
        }}
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn @click="onConfirm" color="red" outline>
          Yes
        </v-btn>
        <v-btn @click="onCancel" color="grey" outline>
          No
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "Confirmation",
  props: ["dialog", "text"],
  methods: {
    onConfirm() {
      this.$emit("confirm");
    },
    onCancel() {
      this.$emit("cancel");
    }
  }
};
</script>

<style></style>
