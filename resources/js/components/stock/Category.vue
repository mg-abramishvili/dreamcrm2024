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
            <a
                v-if="$store.getters.userHasPermission('stock', 'create')"
                href="#" class="btn btn-primary">
                    Добавить
            </a>
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />

        <div v-if="!views.loading" class="content-table">
            <table class="table table-clickable">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Остаток (общий)</th>
                        <th>Последняя цена</th>
                        <th>Нехватка</th>
                    </tr>
                </thead>
                <tbody>
                    <tr @click="goToItem(item.id)" v-for="item in category.items">
                        <td>{{ item.name }}</td>
                        <td :class="{'text-success': item.balance_qty > 0, 'text-more-muted': item.balance_qty == 0}">{{ item.balance_qty }}</td>
                        <td>{{ $filters.currencyRub(item.latest_balance_price) }} <small class="d-block text-muted">{{ $filters.date(item.latest_balance_date) }}</small></td>
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
