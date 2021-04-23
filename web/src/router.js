import Vue from 'vue'
import VueRouter from 'vue-router';

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name:'index',
        component:  require('./views/Home.vue').default,
    },
    {
        path: '/email/:id',
        name:'show',
        component:  require('./views/Single.vue').default,
    },

];

export default new VueRouter({
    routes,
    linkActiveClass:'active',
    mode: 'history'
})