<template>
    <div class="header">
        <div class="header-name">
            <h1>Настройки CRM</h1>
        </div>

        <div class="header-buttons">
            <!-- <a href="#" class="btn btn-primary"></a> -->
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />

        <div v-if="!views.loading" class="content-simple">
            <div class="row align-items-center mb-4">
                <div class="col-3">
                    <label class="col-form-label">Добавка к курсу доллара, %</label>
                </div>
                <div class="col-2">
                    <input v-model="usd_additional" type="number" class="form-control">
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-3">
                    <label class="col-form-label">Стоимость дня сборки</label>
                </div>
                <div class="col-2">
                    <input v-model="sborka_arenda" type="number" class="form-control">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-3">
                    <label class="col-form-label">Стоимость дня человека для сборки</label>
                </div>
                <div class="col-2">
                    <input v-model="sborka_person" type="number" class="form-control">
                </div>
            </div>

            <button @click="save()" class="btn btn-primary mt-4">Сохранить</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            settings: {},

            usd_additional: 0,
            sborka_arenda: 0,
            sborka_person: 0,

            views: {
                loading: true,
            },
        }
    },
    created() {
        this.loadSettings()
    },
    methods: {
        loadSettings() {
            axios.get('/api/settings')
            .then(response => {
                this.settings = response.data

                this.usd_additional = response.data.usd_additional
                this.sborka_arenda = response.data.sborka_arenda
                this.sborka_person = response.data.sborka_person

                this.views.loading = false
            })
        },
        save() {
            axios.put('/api/settings', {
                usd_additional: this.usd_additional,
                sborka_arenda: this.sborka_arenda,
                sborka_person: this.sborka_person,
            })
            .then(response => {
                this.loadSettings()

                return this.$toast.success('Настройки сохранены')
            })
            .catch(errors => {
                return this.$toast.error(errors.response.data ? errors.response.data : errors)
            })
        },
    },
}
</script>