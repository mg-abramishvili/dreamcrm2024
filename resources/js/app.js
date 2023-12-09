import './bootstrap'

import { createApp } from 'vue'

import Router from './router'

import store from './store'

import App from './App.vue'

import globalFilters from './globalFilters'

import Loader from './components/Loader.vue'

// Vue Toast Notification
import ToastPlugin from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-default.css'

const app = createApp(App)
            .component('Loader', Loader)
            .use(Router)
            .use(store)
            .use(ToastPlugin, {
                position: 'top'
            })

app.config.globalProperties.$filters = globalFilters

app.mount('#app')