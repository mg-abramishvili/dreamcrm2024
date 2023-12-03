<template>
    <div class="header">
        <div class="header-name">
            <h1>Юзеры</h1>
        </div>

        <div class="header-buttons">
            <a href="#" class="btn btn-primary">Добавить</a>
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />

        <div v-if="!views.loading" class="content-folders">
            <div v-for="user in users" class="content-folder">
                <RouterLink :to="{name: 'User', params: {id: user.id}}">
                    <div class="content-folder-pic" :style="{ backgroundImage: 'url(' + userAvatar(user) + ')' }"></div>
                    
                    <span>
                        {{ user.name }}
                    </span>
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],

            views: {
                loading: true,
            },
        }
    },
    created() {
        this.loadUsers()
    },
    methods: {
        loadUsers() {
            axios.get('/api/users')
            .then(response => {
                this.users = response.data

                this.views.loading = false
            })
            .catch(errors => {
                this.$toast.error(errors.response.data ? errors.response.data : errors)
                
                this.views.loading = false
            })
        },
        userAvatar(user) {
            return user.avatar ? user.avatar : '/img/ava.jpg'
        },
    },
}
</script>