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
                    <input type="number" class="form-control">
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-3">
                    <label class="col-form-label">Стоимость дня сборки</label>
                </div>
                <div class="col-2">
                    <input type="number" class="form-control">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-3">
                    <label class="col-form-label">Стоимость дня аренды</label>
                </div>
                <div class="col-2">
                    <input type="number" class="form-control">
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
        this.views.loading = false
    },
    methods: {
        //
    },
}
</script>