import Vue from 'vue';
import Vuex from 'vuex'
Vue.use(Vuex)
import createPersistedState from "vuex-persistedstate";
import router from '../router/route'
const store = new Vuex.Store({
    plugins: [createPersistedState()],
    state: {
      massage:"Welcome, People",
      authenticated:false,

    },
    getters: {

      getAuthenticated(state){
          return state.authenticated;
      },

    },
    mutations:{

        SET_AUTHENTICATED(state,data){
            state.authenticated = data;
        }

    },


    actions:{
        authUser ({ commit, dispatch }) {
          return axios.get('/api/auth/user/data').then((response) => {
              commit('SET_AUTHENTICATED', true)
              let user = response.data;
              console.log("working this now")
             // set user-data on local storage
             localStorage.setItem('auth',true);
             localStorage.setItem('authuser', JSON.stringify(user));

          })
        },
      },


  })

export default store;

// state data seen to using getters and also using getMassage() function

// mutations set data into state and then this data return on getters function;

// auth(login)->mutations(SET_USER)->state(user)->gutters(getUser)->dashboard(index)
