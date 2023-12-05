<template>
    <div class="header">
        <h1>Расчёты</h1>

        <div class="header-buttons">
            <RouterLink :to="{name: 'CreateCalculation'}" class="btn btn-primary">Новый расчёт</RouterLink>
        </div>
    </div>

    <SearchPanel v-if="!views.loading" />

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
                    <tr @click="goToCalculation(calculation.id)" v-for="item in calculations">
                        <td>{{ calculation }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import SearchPanel from './SearchPanel.vue'

export default {
    data() {
        return {
            calculations: [],

            views: {
                loading: true,
            }
        }
    },
    created() {
        this.loadCalculations()
    },
    methods: {
        loadCalculations() {
            axios.get('/api/calculations')
            .then(response => {
                this.calculations = response.data

                this.views.loading = false
            })
        },
        goToCalculation(id) {
            console.log(id)
        },
    },
    components: {
        SearchPanel
    }
}
</script>