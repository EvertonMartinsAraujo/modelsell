/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import Login from './components/Login.vue';
import Catalogo from './components/Catalogo.vue';
import { createRouter, createWebHistory } from 'vue-router';



const routes = [
    {
      path: '/', component: Login,
      props: { imageUrl: '/images/Logo.png'}
    },
    { 
      path: '/catalogo', component: Catalogo, 
      meta: { requiresAuth: true }
    }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

//confirmar autenticacao
router.beforeEach((to, from, next) => {
  const autenticado = !!localStorage.getItem('token')

  if (to.meta.requiresAuth && !autenticado) {
    next('/') // redireciona pro login
  } else {
    next()
  }
});
















//import { createApp } from 'vue';


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

//const app = createApp({});

//import ExampleComponent from './components/ExampleComponent.vue';
//app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

const app = createApp(App);

app.use(router);
app.mount('#app');
