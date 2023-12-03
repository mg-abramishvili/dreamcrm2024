<template>
    <div class="offcanvas offcanvas-end show" tabindex="-1" id="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">{{ balance_id ? 'Остаток' : 'Новый остаток' }}</h5>
            <button type="button" class="btn-close" @click="$parent.views.balanceMaster = false"></button>
        </div>
        <div class="offcanvas-body">
            <Loader v-if="views.loading" />

            <form v-if="!views.loading" @submit.prevent="save()">
                <input type="number" v-model="quantity" class="form-control">
            
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
            quantity: 0,
            date: '',
            pre_rub: 0,
            pre_usd: 0,
            price: 0,
            usd_kurs: 0,

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
    methods: {
        loadBalance() {
            axios.get(`/api/stock-balance/${this.balance_id}`)
            .then(response => {
                this.quantity = response.data.quantity

                this.views.loading = false
            })
        },
        save() {
            console.log('save')

            this.$parent.loadBalances()
            
            this.$parent.views.balanceMaster = false
        },
    },
}
</script>