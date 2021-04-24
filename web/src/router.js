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
        path: '/email/id/:id',
        name:'show',
        component:  require('./views/Single.vue').default,
    },
    {
        path: '/login',
        name:'login',
        component:  require('./views/Login.vue').default,
    },
    {
        path: '/email/recipient/:recipient',
        name:'recipients',
        component:  require('./views/Recipients.vue').default,
    },
    {
        path: '/create',
        name:'create',
        component:  require('./views/Create.vue').default,
    },
];

export default new VueRouter({
    routes,
    linkActiveClass:'active',
    mode: 'history'
})