import PageLoader from './components/helpers/PageLoader.vue'
import ErrorPage from './components/helpers/ErrorPage.vue'

import('./bootstrap')
import {createApp} from 'vue'
import {createRouter, createWebHistory} from 'vue-router';
import App from './screens/App.vue'
import ExampleComponent from "./components/ExampleComponent.vue";
import AdminView from "./screens/AdminView.vue";
import Splash from "./screens/Splash.vue";
import PestEditor from "./screens/PestEditor.vue";


// Register screens
const routes = [
    // We use the webpack chunk name option to make sure the file goes into public/js/NAME.
    // Without this setting, the file name will be a numeric value that makes it hard to find.
    {
        path: '/',
        component: Splash,
    },
    {
        path: '/glossary',
        component: Splash,
    },
    {
        path: '/about',
        component: Splash,
    },
    {
        path: '/admin',
        component: AdminView,//() => AsyncComponent(import (/* webpackChunkName: "js/dashboard" */'./screens/AdminView.vue')),
    },
    // {
    //     path: '/pests/editor',
    //     component: PestEditor,
    // },
    // {
    //     path: '/pests/editor/:id',
    //     component: PestEditor,
    // },

    // {
    //     path: '/admin/observations',
    //     component: () => AsyncComponent(import (/* webpackChunkName: "js/observations-browser" */'./screens/ObservationsBrowser.vue')),
    // }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App)
    .use(router)
    .mount('#app')