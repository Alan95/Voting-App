import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const api = '/api/login';

export const store = new Vuex.Store({
    state: {
        user: false
    },
    mutations: {
        fetchUser(state){
            axios.get(api).then(res => { state.user = res.data }).catch(err => { console.log(err)})
        }
    },
    actions: {
        fetchUser: ({ commit }) => commit('fetchUser')
    },
    getters: {
        user: state => {
            return state.user
        }
    }
});
