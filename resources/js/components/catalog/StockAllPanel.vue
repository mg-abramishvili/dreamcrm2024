<template>
    <div class="offcanvas offcanvas-end show" tabindex="-1" id="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Склад</h5>
            <button type="button" class="btn-close" @click="$parent.views.stockAllPanel = ''"></button>
        </div>
        <div class="offcanvas-body">
            <Loader v-if="views.loading" />

            <div class="stock-all-search mb-4">
                <input v-model="searchInput" type="text" class="form-control" placeholder="Поиск по складу...">
            </div>

            <div v-if="!views.loading" class="stock-all-selector">
                <div v-for="item in searchedItems" class="stock-all-selector-item">
                    <div class="row align-items-center">
                        <button
                            @click="add(item)"
                            class="btn">
                                {{ item.name }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div @click="$parent.views.stockAllPanel = ''" class="offcanvas-backdrop fade show"></div>
</template>

<script>
export default {
    data() {
        return {
            items: [],

            searchInput: '',
            
            views: {
                loading: true,
            }
        }
    },
    created() {
        this.loadStock()
    },
    computed: {
        searchedItems() {
            return this.items.filter(itm => {
                return itm.name.toLowerCase().includes(this.searchInput.toLowerCase())
            })
        }
    },
    methods: {
        loadStock() {
            axios.get(`/api/stock-items`)
            .then(response => {
                this.items = response.data.data

                this.views.loading = false
            })
        },
        add(item) {
            let itemAlreadyAdded = this.$parent.selected.items.find(i => i.id == item.id)

            if(itemAlreadyAdded) {
                return this.$toast.error('Позиция уже добавлена')
            }

            this.$parent.selected.items.push({
                id: item.id,
                name: item.name,
                pre_rub: item.latest_balance_pre_rub,
                pre_usd: item.latest_balance_pre_usd,
                price: item.latest_balance_price,
                usd_kurs: item.latest_balance_usd_kurs,
                quantity: 1,
            })
        },
    }
}
</script>