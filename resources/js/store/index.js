  
import Vuex from 'vuex';
import Vue from 'vue';
import loggedtimeUsers from './modules/loggedtimeUsers';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        loggedtimeUsers
    }
});