import axios from 'axios';

const END_POINT_URL = "http://localhost:8000/api/loggedtime/";

const state = {
    loggedtime: []
};

const getters = {
    allLoggedTimes: state => state.loggedtime
};

const actions = {
    async getLoggedTimes({ commit }) {
        const response = await axios.get(END_POINT_URL);    
        commit('setLoggedTimes', response.data);
    }
};

const mutations = {
    setLoggedTimes: (state, loggedtime) => state.loggedtime = loggedtime,
};

export default {
    state, getters, actions, mutations
}