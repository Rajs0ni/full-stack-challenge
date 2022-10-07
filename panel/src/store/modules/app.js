import {EventBus} from '@/event-bus.js';
import {getField, updateField} from 'vuex-map-fields';

function initialState() {
  return {
    app: {
      layout: 'LAYOUT_APP',
    }
  };
}

const state = initialState();

// actions

const actions = {
  showMessage: (context, payload) => {
    EventBus.$emit('showMessage', payload);
  },
  showLoader(context) {
    EventBus.$emit('showLoader');
  },
  hideLoader(context) {
    EventBus.$emit('hideLoader');
  },
  updateLocale(context, payload) {
    context.commit('set_locale', payload);
  },
};

// getters
const getters = {
  getField,

  appLayout: (state) => state.app.layout,
};

// mutations
const mutations = {
  updateField,
  reset(state) {
    // acquire initial state
    const s = initialState();
    Object.keys(s).forEach((key) => {
      state[key] = s[key];
    });
  },
};

export default {
  namespaced: true,
  state,
  actions,
  getters,
  mutations,
};
