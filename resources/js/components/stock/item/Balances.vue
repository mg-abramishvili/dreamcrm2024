<template>
    <Loader v-if="views.loading" />

    <button v-if="!views.loading"
        @click="add()"
        class="btn btn-primary mt-2 mb-3">
            Добавить остаток
    </button>

    <table v-if="!views.loading" class="table">
        <thead>
            <tr>
                <th>Дата</th>
                <th>Кол-во</th>
                <th>Рубли</th>
                <th>Доллары</th>
                <th>Стоимость</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="balance in balances">
                <td>
                    {{ $filters.date(balance.date) }}
                </td>
                <td>
                    {{ balance.quantity }}
                </td>
                <td>
                    {{ $filters.currencyRub(balance.pre_rub) }}
                </td>
                <td>
                    {{ $filters.currencyUsd(balance.pre_usd) }}
                    <small class="d-block text-muted">курс {{ balance.usd_kurs }}</small>
                </td>
                <td>
                    {{ $filters.currencyRub(balance.price) }}
                </td>
                <td class="text-end">
                    <button @click="edit(balance.id)" class="btn btn-sm btn-outline-secondary me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    </button>

                    <button @click="del(balance.id)" class="btn btn-sm btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <BalanceMaster v-if="views.balanceMaster"
        :item_id="item_id"
        :balance_id="selected.balance"
    />
</template>

<script>
import BalanceMaster from './BalanceMaster.vue'

export default {
    props: ['item_id'],
    data() {
        return {
            balances: [],

            selected: {
                balance: '',
            },

            views: {
                loading: true,
                balanceMaster: false,
            }
        }
    },
    created() {
        this.loadBalances()
    },
    methods: {
        loadBalances() {
            axios.get(`/api/stock-item/${this.item_id}/balances`)
            .then(response => {
                this.balances = response.data

                this.views.loading = false
            })
        },
        add() {
            this.selected.balance = ''

            this.views.balanceMaster = true
        },
        edit(id) {
            this.selected.balance = id

            this.views.balanceMaster = true
        }
    },
    components: {
        BalanceMaster,
    }
}
</script>
