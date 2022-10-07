import {updateField} from 'vuex-map-fields';
import * as API from '@/api';

function initialState () {
  return {
    list: [],
    property: null,
  };
}

const state = initialState ();

// actions
const actions = {
  async create (context, payload) {
    var response = await API.property.create (payload);
    //update list after property is crated
    await context.dispatch ('list');
    return response;
  },

  async get (context, payload) {
    var property = context.getters['getProperty'] (payload.id);
    /* if not in state get from api */
    if (property == undefined) {
      var response = await API.property.get (payload);
      property = response.property;
    }
    return property;
  },

  async delete (context, payload) {
    var response = await API.property.delete (payload);
    return response;
  },

  async list (context, payload) {
    var response = await API.property.list (payload);
    // set properties in list
    context.commit ('set_list', {
      properties: response.properties,
    });
    return response;
  },

  async update (context, payload) {
    var response = await API.property.update (payload);
    await context.dispatch ('list');
    return response;
  },
};

// getters
const getters = {
  getProperty: state => id => {
    var property = null;
    if(state.list.data){
      property = state.list.data.find (property => {
        return property.id == id;
      });
    }
    return property;
  },
};

// mutations
const mutations = {
  updateField,
  set_list (state, payload) {
    state.list = payload.properties;
  },
  reset (state) {
    // acquire initial state
    const s = initialState ();
    Object.keys (s).forEach (key => {
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
