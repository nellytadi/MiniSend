import Vue from 'vue'
import VueRouter from 'vue-router';
import store from "@/store/store";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name:'home',
        component:  require('./views/Home.vue').default,
        meta: { requiresAuth: true },
    },
    {
        path: '/email/id/:id',
        name:'show',
        component:  require('./views/Single.vue').default,
        meta: { requiresAuth: true },
    },

    {
        path: '/login',
        name:'login',
        component:  require('./views/Login.vue').default,
        beforeEnter(to, from, next) {
            if (store.state.auth.token) {
                next(false);
            } else {
                next();
            }
        }
    },
    {
        path: '/email/recipient/:recipient',
        name:'recipients',
        component:  require('./views/Recipients.vue').default,
        meta: { requiresAuth: true },
    },
    {
        path: '/create',
        name:'create',
        component:  require('./views/Create.vue').default,
        meta: { requiresAuth: true },
    },
];



const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token");
    if (to.matched.some(record => record.meta.requiresAuth) && !token) {
        next({ path: "/login", query: { redirect: to.fullPath } });
    } else {
        next(); // make sure to always call next()!
    }
});



export default router