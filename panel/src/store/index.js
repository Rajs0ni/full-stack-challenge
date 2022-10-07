import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

//importing modules
import property from './modules/property';
import propertyType from './modules/propertyType';
import app from './modules/app';

Vue.use (Vuex);

export default new Vuex.Store ({
    state: {},
    actions: {},
    modules: {
        property,
        propertyType,
        app
    },
    plugins: [
        createPersistedState ({
          key: 'app-property-admin-panel',
        }),
    ],
});
