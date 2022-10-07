import * as API from '@/api';

function initialState () {
  return {
    list: [],
    propertyType: null,
  };
}

const state = initialState ();


const actions = {
    async list (context, payload) {
        var response = await API.propertyType.list (payload);
        // set property types in list
        context.commit ('set_list', {
            propertyTypes: response.propertyTypes,
        });
        return response;
      },
}

// getters
const getters = {}

// mutations
const mutations = {
    set_list (state, payload) {
      state.list = payload.propertyTypes;
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