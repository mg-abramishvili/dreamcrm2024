<template>
    <button
        @click="views.stockAllPanel = true"
        class="btn btn-primary mt-2 mb-2">
        Добавить
    </button>

    <div class="stock-selector">
        <div v-for="item in selected.items" class="stock-selector-item mb-1">
            <div class="row align-items-center">
                <div class="col-10" style="width: 70%">
                    {{ item.name }}
                    <small class="d-block text-more-muted">
                        {{ $filters.currencyRub(item.price) }} ({{ priceDetailed(item) }})
                    </small>
                </div>

                <div class="col-1" style="width: 10%">
                    <div class="input-group input-group-sm">
                        <button @click="minus(item.id)"
                            class="btn btn-outline-secondary"
                            type="button"
                            :id="'button-addon-minus' + item.id">
                            -
                        </button>

                        <input v-model="selected.items.find(i => i.id == item.id).quantity" type="text" class="form-control text-center fw-bold text-primary" placeholder="">
                        
                        <button @click="plus(item.id)"
                            class="btn btn-outline-secondary"
                            type="button"
                            :id="'button-addon-plus' + item.id">
                            +
                        </button>
                    </div>
                </div>
                <div class="col-1 text-end" style="width: 20%">
                    {{ $filters.currencyRub(item.price * item.quantity) }}
                </div>
            </div>
        </div>
    </div>

    <StockAllPanel v-if="views.stockAllPanel" />
</template>

<script>
import StockAllPanel from './StockAllPanel.vue'

export default {
    props: ['item', 'box'],
    data() {
        return {
            selected: {
                items: [],
            },

            views: {
                stockAllPanel: false,
            }
        }
    },
    created() {
        if(this.item) {
            this.loadItemStock()
        }

        if(this.box) {
            this.loadBoxStock()
        }
    },
    watch: {
        selected: {
            deep: true,
            handler() {
                this.$parent.selected.stockItems = this.selected.items
            }
        }
    },
    methods: {
        loadBoxStock() {
            this.selected.items = this.box.stock_items
        },
        loadItemStock() {
            this.selected.items = this.item.stock_items
        },
        plus(itemID) {
            let itm = this.selected.items.find(i => i.id == itemID)

            itm.quantity = itm.quantity + 1
        },
        minus(itemID) {
            let itm = this.selected.items.find(i => i.id == itemID)

            if(itm.quantity > 0) {
                itm.quantity = itm.quantity - 1
            }
        },
        priceDetailed(item) {
            let priceDetailed = []

            if(item.pre_rub == 0) {
                priceDetailed.push(this.$filters.currencyRub(0))
            }

            if(item.pre_rub > 0) {
                priceDetailed.push(this.$filters.currencyRub(item.pre_rub))
            }

            if(item.pre_usd == 0) {
                priceDetailed.push('$' + item.pre_usd)
            }

            if(item.pre_usd > 0) {
                priceDetailed.push('$' + item.pre_usd + ' по курсу ' + item.usd_kurs)
            }

            return priceDetailed.join(' + ')
        },
    },
    components: {
        StockAllPanel,
    }
}
</script>