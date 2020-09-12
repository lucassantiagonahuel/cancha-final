import Vue from 'vue'
import VueRouter from 'vue-router'


import Login from '../views/Login.vue'
import Home from '../views/Home.vue'
import Clientes from '../views/Clientes.vue'
import Turnos from '../views/Turnos.vue'
import Cobranzas from '../views/Cobranzas.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/inicio',
    name: 'Home',
    component: Home
  },
  {
    path: '/clientes',
    name: 'Clientes',
    component: Clientes
  },
  {
    path: '/turnos',
    name: 'Turnos',
    component: Turnos
  },
  {
    path: '/cobranzas',
    name: 'Cobranzas',
    component: Cobranzas
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
