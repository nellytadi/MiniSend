import Vue from 'vue';
import App from './App.vue';
import router from "./router";
import index from './store/index';
import axios from 'axios';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

axios.defaults.withCredentials = true
axios.defaults.baseURL = process.env.VUE_APP_URL


Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component('pagination', require('laravel-vue-pagination'))

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
index,
  router,
}).$mount('#app')
