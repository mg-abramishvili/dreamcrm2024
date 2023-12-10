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

            <div v-if="$store.getters.userHasPermission('users', 'create')" class="content user-permissions w-50">
                <h5 class="mb-4">Права</h5>

                <UserPermissionItem
                    permissionTitle="Расчёты"
                    permission="calculations"
                />

                <UserPermissionItem
                    permissionTitle="Проекты"
                    permission="projects"
                />

                <UserPermissionItem
                    permissionTitle="Производство"
                    permission="productions"
                />

                <UserPermissionItem
                    permissionTitle="Каталог"
                    permission="catalog"
                />

                <UserPermissionItem
                    permissionTitle="Склад"
                    permission="stock"
                />

                <UserPermissionItem
                    permissionTitle="Клиенты"
                    permission="clients"
                />

                <UserPermissionItem
                    permissionTitle="Юзеры"
                    permission="users"
                />

                <UserPermissionItem
                    permissionTitle="Настройки"
                    permission="settings"
                />
            </div>
        </div>
    </div>
</template>

<script>
import UserPermissionItem from './UserPermissionItem.vue'

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
    components: {
        UserPermissionItem
    }
}
</script>
