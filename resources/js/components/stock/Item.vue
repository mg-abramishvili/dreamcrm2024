<template>
    <div class="header">
        <div class="header-name">
            <RouterLink
                :to="{name: 'StockCategory', params: {id: item.category_id}}"
                class="header-back-button">
            </RouterLink>

            <h1>{{ item.name }}</h1>
        </div>

        <div class="header-buttons">
            <!-- <a href="#" class="btn btn-primary"></a> -->
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />

        <div v-if="!views.loading" class="content">
            <nav>
                <div class="nav nav-tabs" role="tablist">
                    <button
                        class="nav-link"
                        @click="views.currentTab = 'general'"
                        :class="{'active': views.currentTab == 'general'}">
                            Общая информация
                    </button>

                    <button
                        class="nav-link"
                        @click="views.currentTab = 'balances'"
                        :class="{'active': views.currentTab == 'balances'}">
                            Остатки
                    </button>
                </div>
            </nav>
            <div class="tab-content">
                <div class="tab-pane" :class="{'show active': views.currentTab == 'general'}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="tab-content-line">
                                <strong>Название:</strong> {{ item.name }}

                                <button
                                    v-if="$store.getters.userHasPermission('stock', 'create')"
                                    @click="views.editPanel = 'name'"
                                    class="btn-content-edit">
                                </button>

                                <ChangeName v-if="views.editPanel == 'name'" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="tab-content-line">
                                <strong>Категория:</strong> {{ item.category_name }}

                                <button
                                    v-if="$store.getters.userHasPermission('stock', 'create')"
                                    @click="views.editPanel ='category'"
                                    class="btn-content-edit">
                                </button>

                                <ChangeCategory v-if="views.editPanel == 'category'" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="tab-content-line">
                                <strong>Нехватка:</strong> {{ item.needs_qty }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" :class="{'show active': views.currentTab == 'balances'}">
                    <Balances v-if="views.currentTab == 'balances'"
                        :item_id="item.id"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Balances from './item/Balances.vue'
import ChangeName from './item/ChangeName.vue'
import ChangeCategory from './item/ChangeCategory.vue'

export default {
    data() {
        return {
            item: {},

            views: {
                loading: true,
                currentTab: 'general',
                editPanel: '',
            },
        }
    },
    created() {
        this.loadItem()
    },
    methods: {
        loadItem() {
            axios.get(`/api/stock-item/${this.$route.params.id}`)
            .then(response => {
                this.item = response.data.data

                this.views.loading = false
            })
        },
    },
    components: {
        Balances,
        ChangeName,
        ChangeCategory,
    }
}
</script>
