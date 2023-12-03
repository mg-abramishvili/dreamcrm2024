<template>
    <Sidebar />

    <main>
        <router-view :key="$route.path"></router-view>
    </main>
</template>

<script>
import Sidebar from './components/Sidebar.vue'

export default {
    methods: {
        darkModeToggle() {
            let body = document.body
            let darkModeClass = 'dark-theme'

            if(!body.classList.contains(darkModeClass)) {
                return body.classList.add(darkModeClass)
            }

            if(body.classList.contains(darkModeClass)) {
                return body.classList.remove(darkModeClass)
            }
        },
    },
    components: {
        Sidebar,
    }
}
</script>