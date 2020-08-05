import Vue from 'vue';
import BootstrapVue from "bootstrap-vue";
import App from './App.vue';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);

let app = new Vue({
    el: '#app',

    components: {
        App
      },
      render: h => h(App)
});
