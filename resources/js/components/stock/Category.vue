<template>
    <div class="header">
        <div class="header-name">
            <RouterLink
                :to="{name: 'Stock'}"
                class="header-back-button">
            </RouterLink>

            <h1>{{ category.name }}</h1>
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
                    <tr @click="goToItem(item.id)" v-for="item in category.items">
                        <td>{{ item.name }}</td>
                        <td>{{ item.balance }}</td>
                        <td>{{ item.needs }}</td>
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
            category: {},

            views: {
                loading: true,
            },
        }
    },
    created() {
        this.loadCategory()
    },
    methods: {
        loadCategory() {
            axios.get(`/api/stock-category/${this.$route.params.id}`)
            .then(response => {
                this.category = response.data

                this.views.loading = false
            })
        },
        goToItem(id) {
            this.$router.push({name: 'StockItem', params: {id: id}})
        },
    },
}
</script>