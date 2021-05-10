require('./bootstrap');

window.Vue = require('vue').default;

import store from './store';

Vue.component('app-component', require('./components/AppComponent.vue').default);

//import router from './routes'

const app = new Vue({
    store,
    el: '#app'
});
