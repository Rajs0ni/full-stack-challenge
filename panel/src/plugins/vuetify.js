import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import ICONS from '@/icons';

import './custom.styl';

Vue.use (Vuetify, {
  iconfont: 'mdi',
  icons: ICONS,
  breakpoint: {
    thresholds: {
      xs: 360,
    },
  },
  theme: {
    primary: '#5BA2EE',
    secondary: '#F4511E',
    accent: '#028090',
    error: '#E53935',
    info: '#71BCF7',
    success: '#02C39A',
    warning: '#FF9F1C',
    greyDarken1: '#757575',
    greyDarken2: '#616161',
    greyDarken3: '#424242'
  },
});
