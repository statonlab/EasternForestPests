/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */



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


// import {createApp} from 'vue';
// import App from "./screens/App.vue";
// import './bootstrap'
// import Vue from 'vue'
// import VueRouter from 'vue-router'
import PageLoader from './components/helpers/PageLoader.vue'
import ErrorPage from './components/helpers/ErrorPage.vue'
//
// /**
//  * Loads a component asynchronously.
//  *
//  * @param component
//  * @return {{component: *, delay: number, loading: {components, name}, error: {name, mounted}, timeout: number}}
//  * @constructor
//  */
// const AsyncComponent = (component) => ({
//     // The component to load (should be a Promise)
//     component,
//     // A component to use while the async component is loading
//     loading: PageLoader,
//     // A component to use if the load fails
//     error: ErrorPage,
//     // Delay before showing the loading component. Default: 200ms.
//     delay: 200,
//     // The error component will be displayed if a timeout is
//     // provided and exceeded. Default: Infinity.
//     timeout: 3000,
// })
//
// // Register screens
// const routes = [
//     // We use the webpack chunk name option to make sure the file goes into public/js/NAME.
//     // Without this setting, the file name will be a numeric value that makes it hard to find.
//     {
//         path: '/adminn',
//         component: () => AsyncComponent(import (/* webpackChunkName: "js/dashboard" */'./screens/Dashboard.vue')),
//     },
//     // {
//     //     path: '/admin/observations',
//     //     component: () => AsyncComponent(import (/* webpackChunkName: "js/observations-browser" */'./screens/ObservationsBrowser.vue')),
//     // }
// ]
//
// Vue.use(VueRouter)
//
//
// // Create the router instance and pass the `routes` option
// const router = new VueRouter({
//     routes,
//     mode: 'history',
// })
//
// // // Create and mount the app
// // new Vue({
// //     router,
// //     components: {
// //         App,
// //     },
// // }).$mount('#app')
//
// const app = createApp({App});
// app.mount('#app');
//______________________________________
import('./bootstrap')

import { createApp } from 'vue'
import App from './screens/App.vue'

const app = createApp({})

app.component('app',App)

app.mount('#app')

// import './bootstrap'
// import Vue from 'vue'
// import App from './screens/App.vue'
// import VueRouter from 'vue-router'
// // import VueI18n from 'vue-i18n'
// // import Notifications from 'vue-notification'
// // import en from './lang/en'
// // import PageLoader from './components/PageLoader'
// // import ErrorPage from './components/ErrorPage'
// // import Alert from './plugins/Alert/Alert'
// // import VCalendar from 'v-calendar'
// // import Title from './plugins/Title'
// // import Downloader from './plugins/Downloader'
// // import Scroll from './plugins/Scroll'
//
// Vue.use(VueRouter)
// // Vue.use(VueI18n)
// // Vue.use(Notifications)
// // Vue.use(Alert)
// // Vue.use(VCalendar)
// // Vue.use(Title)
// // Vue.use(Downloader)
// // Vue.use(Scroll)
//
//
// /**
//  * Loads a component asynchronously.
//  *
//  * @param component
//  * @return {{component: *, delay: number, loading: {components, name}, error: {name, mounted}, timeout: number}}
//  * @constructor
//  */
// const AsyncComponent = (component) => ({
//     // The component to load (should be a Promise)
//     component,
//     // A component to use while the async component is loading
//     loading: PageLoader,
//     // A component to use if the load fails
//     error: ErrorPage,
//     // Delay before showing the loading component. Default: 200ms.
//     delay: 200,
//     // The error component will be displayed if a timeout is
//     // provided and exceeded. Default: Infinity.
//     timeout: 3000,
// })
//
// // Register screens
// const routes = [
//     // We use the webpack chunk name option to make sure the file goes into public/js/NAME.
//     // Without this setting, the file name will be a numeric value that makes it hard to find.
//     {
//         path     : '/admin',
//         component: () => AsyncComponent(import (/* webpackChunkName: "js/dashboard" */'./screens/Dashboard.vue')),
//     },
//     // {
//     //     path     : '/admin/documentation',
//     //     component: () => AsyncComponent(import (/* webpackChunkName: "js/posts" */'./screens/documentation/Posts')),
//     // },
//     // {
//     //     path     : '/admin/documentation/:id',
//     //     component: () => AsyncComponent(import (/* webpackChunkName: "js/post" */'./screens/documentation/Post')),
//     // },
// ]
//
// // Create the router instance and pass the `routes` option
// const router = new VueRouter({
//     routes,
//     mode: 'history',
// })
//
// // Create and mount the app
// new Vue({
//     router,
//     components: {
//         App,
//     },
// }).$mount('#app')
