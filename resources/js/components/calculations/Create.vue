<template>
    <div class="header">
        <div class="header-name">
            <RouterLink
                :to="{name: 'Calculations'}"
                class="header-back-button">
            </RouterLink>

            <h1>Новый расчёт</h1>
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />
        
        <div v-if="!views.loading" class="calculation-creator">
            <ul>
                <li v-for="box in boxes">
                    {{ box.name }}, {{ box.pre_rub }}, {{ box.pre_usd }}, {{ box.price }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            boxes: [],

            views: {
                loading: true,
            },
        }
    },
    created() {
        this.loadBoxes()
    },
    methods: {
        loadBoxes() {
            axios.get(`/api/catalog-boxes`)
            .then(response => {
                this.boxes = response.data.data

                this.views.loading = false
            })
        },
    },
}
</script>