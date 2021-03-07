import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../components/layouts/Home' //'../views/Home.vue'
import Dashboard from '../components/layouts/Dashboard'

import Clients from '../components/layouts/Clients'
import AddClient from '../components/clients/AddClient'
import EditClient from '../components/clients/EditClient'

import Transactions from '../components/layouts/Transactions'
import AddTransaction from '../components/transactions/AddTransaction'

import Login from '../components/layouts/Login'
import store from '../store' // '@/store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/home',
    name: 'Home',
    component: Home
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    beforeEnter: (to, from, next) => {
      // console.log('middleware')
      if( ! store.getters['auth/authenticated'] ){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
    {
    path: '/clients',
    name: 'Clients',
    component: Clients,
    beforeEnter: (to, from, next) => {
      // console.log('middleware')
      if( ! store.getters['auth/authenticated'] ){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
    {
        path: '/clients/add',
        name: 'AddClient',
        component: AddClient,
        beforeEnter: (to, from, next) => {
            // console.log('middleware')
            if( ! store.getters['auth/authenticated'] ){
                return next({
                    name: 'Login'
                })
            }
            next()
        }
    },
    {
        path: '/clients/edit/:id',
        name: 'EditClient',
        component: EditClient,
        beforeEnter: (to, from, next) => {
            // console.log('middleware')
            if( ! store.getters['auth/authenticated'] ){
                return next({
                    name: 'Login'
                })
            }
            next()
        }
    },
    {
        path: '/transactions',
        name: 'Transactions',
        component: Transactions,
        beforeEnter: (to, from, next) => {
            if( ! store.getters['auth/authenticated'] ){
                return next({
                    name: 'Login'
                })
            }
            next()
        }
    },
    {
        path: '/transactions/add',
        name: 'AddTransaction',
        component: AddTransaction,
        beforeEnter: (to, from, next) => {
            // console.log('middleware')
            if( ! store.getters['auth/authenticated'] ){
                return next({
                    name: 'Login'
                })
            }
            next()
        }
    },
    {
        path: '/transactions/client/:id',
        name: 'Transactions',
        component: Transactions,
        beforeEnter: (to, from, next) => {
            if( ! store.getters['auth/authenticated'] ){
                return next({
                    name: 'Login'
                })
            }
            next()
        }
    },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../components/layouts/About' /* '../views/About.vue'*/)
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
