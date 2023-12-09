<template>
    <div class="offcanvas offcanvas-end show" tabindex="-1" id="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">{{ balance_id ? 'Остаток' : 'Новый остаток' }}</h5>
            <button type="button" class="btn-close" @click="$parent.views.balanceMaster = false"></button>
        </div>
        <div class="offcanvas-body">
            <Loader v-if="views.loading" />

            <form v-if="!views.loading" @submit.prevent="save()">
                <div class="mb-4">
                    <label class="form-label">Кол-во</label>
                    <input v-model="quantity" type="number" min="0" class="form-control">
                </div>
                <div class="mb-4">
                    <label class="form-label">Дата</label>
                    <input v-model="date" type="date" class="form-control">
                </div>
                <div class="mb-4">
                    <label class="form-label">Цена RUB</label>
                    <input v-model="pre_rub" type="number" min="0" class="form-control">
                </div>
                <div class="mb-4">
                    <label class="form-label">Цена USD</label>
                    <input v-model="pre_usd" type="number" min="0" class="form-control">
                </div>
                <div class="mb-4">
                    <label class="form-label">Цена итог</label>
                    <input v-model="price" type="number" class="form-control" disabled>
                </div>
                <div class="mb-4">
                    <label class="form-label">Курс USD</label>
                    <input v-model="usd_kurs" type="number" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
            </form>
        </div>
    </div>

    <div @click="$parent.views.balanceMaster = false" class="offcanvas-backdrop fade show"></div>
</template>

<script>
export default {
    props: ['item_id', 'balance_id'],
    data() {
        return {
            balance: {},

            date: this.$filters.currentDate(),
            quantity: 0,
            usd_kurs: this.$store.state.usdKurs,
            pre_rub: 0,
            pre_usd: 0,

            views: {
                loading: true,
            }
        }
    },
    created() {
        if(this.balance_id) {
            this.loadBalance()
        }

        if(!this.balance_id) {
            this.views.loading = false
        }
    },
    computed: {
        price() {
            if(!this.pre_rub) {
                this.pre_rub = 0
            }
            if(!this.pre_usd) {
                this.pre_usd = 0
            }

            return Math.ceil((parseFloat(this.pre_rub) + (parseFloat(this.usd_kurs) * parseFloat(this.pre_usd))))
        }
    },
    methods: {
        loadBalance() {
            axios.get(`/api/stock-balance/${this.balance_id}`)
            .then(response => {
                this.balance = response.data

                this.date = response.data.date
                this.quantity = response.data.quantity
                this.usd_kurs = response.data.usd_kurs
                this.pre_usd = response.data.pre_usd
                this.pre_rub = response.data.pre_rub

                this.views.loading = false
            })
        },
        save() {
            if(!this.date) {
                return this.$toast.error("Укажите дату")
            }
            if(!this.quantity || this.quantity == 0) {
                return this.$toast.error("Укажите количество")
            }
            if(!this.usd_kurs || this.usd_kurs == 0) {
                return this.$toast.error("Укажите курс доллара")
            }
            if(!this.price || this.price == 0) {
                return this.$toast.error("Укажите стоимость")
            }

            axios({
                method: this.balance_id ? 'put' : 'post',
                url: this.balance_id ? `/api/stock-balance/${this.balance_id}/update` : '/api/stock-balances',
                data: {
                    stock_item_id: this.item_id,
                    date: this.date,
                    quantity: this.quantity,
                    usd_kurs: this.usd_kurs,
                    pre_rub: this.pre_rub,
                    pre_usd: this.pre_usd,
                    price: this.price,
                }
            })
            .then(response => {
                this.$parent.loadBalances()

                this.$parent.views.balanceMaster = false
            })
            .catch(errors => {
                return this.$toast.error(errors.response.data ? errors.response.data : errors)
            })
        },
    },
}
</script>
