<template>
    <div class="header">
        <div class="header-name">
            <RouterLink
                :to="{name: 'Users'}"
                class="header-back-button">
            </RouterLink>

            <h1>{{ user.name }}</h1>
        </div>

        <div class="header-buttons">
            <!-- <a href="#" class="btn btn-primary"></a> -->
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />

        <div v-if="!views.loading" class="content">
            <p>{{ user.name }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},

            views: {
                loading: true,
            },
        }
    },
    created() {
        this.loadUser()
    },
    methods: {
        loadUser() {
            axios.get(`/api/user/${this.$route.params.id}`)
            .then(response => {
                this.user = response.data

                this.views.loading = false
            })
        },
        userAvatar() {
            return this.user.avatar ? this.user.avatar : '/img/ava.jpg'
        },
    },
}
</script>