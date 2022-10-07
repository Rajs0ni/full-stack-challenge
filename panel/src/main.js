import Vue from 'vue';
import App from './App.vue';
import './plugins/vuetify';
import router from './router';
import store from '@/store';
import DEFINES from '@/defines';
import moment from 'moment';

Vue.prototype.DEFINES = DEFINES;
Vue.prototype.moment = moment;

new Vue ({
    router,
    store,
    render: h => h (App)
  }).$mount ('#app');
