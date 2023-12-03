import './bootstrap'

import { createApp } from 'vue'

import Router from './router'

import App from './App.vue'

// Global Filters
import globalFilters from './globalFilters'

// Loader
import Loader from './components/Loader.vue'

// Vue Toast Notification
import ToastPlugin from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-default.css'

const app = createApp(App)
            .component('Loader', Loader)
            .use(Router)
            .use(ToastPlugin, {
                position: 'top'
            })

app.config.globalProperties.$filters = globalFilters

app.mount('#app')