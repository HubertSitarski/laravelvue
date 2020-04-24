import Vue from 'vue'
import Router from 'vue-router'
import Login from './views/Login'
import Register from './views/Register'
import Advertisements from './views/Advertisements'
import AdvertisementsDetails from './views/AdvertisementsDetails'
import localforage from "localforage";
import store from './store'

Vue.use(Router)

export const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login
        },
        {
            path: '/logout',
            name: 'logout',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/advertisements',
            name: 'advertisements',
            component: Advertisements,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/advertisements/:id',
            name: 'advertisements-details',
            component: AdvertisementsDetails,
        },
    ]
})

router.beforeEach((to, from, next) => {
    // logout
    if(to.name === 'logout'){
        localforage.removeItem('user').then(() => {
            localforage.removeItem('authUser').then(() => {
                store.dispatch('addNotification', {
                    type: 'success',
                    title: 'Logowanie',
                    content: 'Zostałeś wylogowany.'
                })
                next({name:'login'})
            })
        })
    }


    if(to.path === '/'){
        localforage.getItem('authUser').then((token) => {
            if(token){
                next({name:'advertisements'})
            } else {
                next()
            }
        })
    }

    if(to.meta.requiresAuth){
        localforage.getItem('authUser').then((value) => {
            const authUser = value
            if(authUser){
                next()
            } else {
                next({name:'login'})
            }
        })
    } else {
        next()
    }
})