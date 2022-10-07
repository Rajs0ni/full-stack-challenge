<template>
  <v-app>
    <v-toolbar color="primary" dark fixed app>
      <v-toolbar-title>Property Admin Panel</v-toolbar-title>
    </v-toolbar>
    <v-content class="content-background">
      <router-view class="ma-3"></router-view>
    </v-content>
    <v-footer color="primary" dark fixed app>
      <v-layout class="pt-1" justify-center row wrap>
        <v-flex xs12 text-xs-center white--text>
          <span> &copy;&nbsp;{{ moment().local().format("YYYY") }} </span>
          <span>&nbsp;—&nbsp;</span>
          <span>Created By <a class="white--text" href="https://www.linkedin.com/in/raj-soni-0b3052136/" target="_blank">RAJ</a></span>
        </v-flex>
      </v-layout>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  name: "AppLayout",
  data() {
    return {
    };
  }
};
</script>
<style scoped>
.content-background {
  background-color: rgb(237, 246, 255) !important;
}
</style>
