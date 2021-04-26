import Vue from 'vue'
import App from './App.vue'
import router from "./router";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from "./store/store";


Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router,
  store
}).$mount('#app')
