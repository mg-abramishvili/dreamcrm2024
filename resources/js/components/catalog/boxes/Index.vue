<template>
    <div class="header">
        <div class="header-name">
            <RouterLink
                :to="{name: 'Catalog'}"
                class="header-back-button">
            </RouterLink>

            <h1>Корпуса</h1>
        </div>

        <div class="header-buttons">
            <a href="#" class="btn btn-primary">Добавить</a>
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />

        <div v-if="!views.loading" class="content-table">
            <table class="table table-clickable">
                <tbody>
                    <tr @click="goToBox(box.id)" v-for="box in boxes">
                        <td>{{ box.name }}</td>
                        <td>{{ box.price }}</td>
                    </tr>
                </tbody>
            </table>
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
                this.boxes = response.data

                this.views.loading = false
            })
        },
        goToBox(id) {
            this.$router.push({name: 'CatalogBox', params: {id: id}})
        },
    },
}
</script>