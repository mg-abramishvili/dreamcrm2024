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

            <div class="content user-permissions w-50">
                <h5 class="mb-4">Права</h5>

                <div class="row align-items-center mb-4">
                    <div class="col-3">
                        Расчёты
                    </div>
                    <div class="col-9">
                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Просмотр</label>
                        </div>

                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Редактирование</label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-3">
                        Проекты
                    </div>
                    <div class="col-9">
                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Просмотр</label>
                        </div>

                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Редактирование</label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-3">
                        Производство
                    </div>
                    <div class="col-9">
                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Просмотр</label>
                        </div>

                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Редактирование</label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-3">
                        Каталог
                    </div>
                    <div class="col-9">
                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Просмотр</label>
                        </div>

                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Редактирование</label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-3">
                        Склад
                    </div>
                    <div class="col-9">
                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Просмотр</label>
                        </div>

                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Редактирование</label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-3">
                        Клиенты
                    </div>
                    <div class="col-9">
                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Просмотр</label>
                        </div>

                        <div class="form-check form-check-inline form-switch me-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Редактирование</label>
                        </div>
                    </div>
                </div>
            </div>
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