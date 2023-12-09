<template>
    <Sidebar />

    <main>
        <router-view :key="$route.path"></router-view>
    </main>
</template>

<script>
import Sidebar from './components/Sidebar.vue'

export default {
    created() {
        this.checkMe()
        this.loadUsdKurs()
    },
    methods: {
        checkMe() {
            if(this.$store.state.user && this.$store.state.user.id) {
                return
            }

            axios.get('/api/whoami')
            .then(response => {
                if(response.data && response.data.id) {
                    this.$store.commit('setUser', response.data)
                }
            })
        },
        loadUsdKurs() {
            if(this.$store.state.usdKurs) {
                return
            }

            axios.get('/api/settings')
                .then(response => {
                    this.$store.commit('setUsdKurs', response.data.usd_kurs)
                })
        },
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
