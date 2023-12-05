<template>
    <button
        @click="views.stockAllPanel = true"
        class="btn btn-primary mt-2 mb-4">
        Добавить
    </button>

    <div class="stock-selector">
        <div v-for="item in selected.items" class="stock-selector-item mb-3">
            <div class="row align-items-center">
                
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
                <div class="col-11" style="width: 90%">
                    {{ item.name }}
                </div>
            </div>
        </div>
    </div>

    <StockAll v-if="views.stockAllPanel" />
</template>

<script>
import StockAll from './StockAll.vue'

export default {
    props: ['box'],
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
        this.loadBoxStock()
    },
    methods: {
        loadBoxStock() {
            this.selected.items = this.box.stock_items.map(({id, name, pivot}) => ({id: id, name: name, quantity: pivot.quantity}))
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
        }
    },
    components: {
        StockAll,
    }
}
</script>