import axios from 'axios';

const END_POINT_URL = "http://localhost:8000/api/loggedtime/";

const state = {
    loggedtimes: []
};

const getters = {
    allLoggedTimes: state => state.loggedtimes
};

const actions = {
    async getLoggedTimes({ commit }) {
        const response = await axios.get(END_POINT_URL);    
        commit('setLoggedTimes', response.data);
    },
    async filterLoggedTimes({ commit }, {search, start_date, end_date, order_by}) {
        const queryParams = new URLSearchParams();
        if(search) queryParams.append('search', search);
        if(start_date) queryParams.append('start_date', start_date);
        if(end_date) queryParams.append('end_date', end_date);
        if(order_by) queryParams.append('order_by', order_by);
        
        const response = await axios.get(END_POINT_URL, { params: queryParams });    
        commit('setLoggedTimes', response.data);
    }
};

const mutations = {
    setLoggedTimes: (state, loggedtimes) => state.loggedtimes = loggedtimes,
};

export default {
    state, getters, actions, mutations
}