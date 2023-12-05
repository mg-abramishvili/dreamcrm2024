<template>
    <div class="header">
        <div class="header-name">
            <RouterLink
                :to="{name: 'CatalogCategory', params: {id: item.category_id}}"
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
                        @click="views.currentTab = 'compatibility'"
                        :class="{'active': views.currentTab == 'compatibility'}">
                            Совместимость
                    </button>

                    <button
                        class="nav-link"
                        @click="views.currentTab = 'stock'"
                        :class="{'active': views.currentTab == 'stock'}">
                            Склад
                    </button>

                    <button
                        class="nav-link"
                        @click="views.currentTab = 'price'"
                        :class="{'active': views.currentTab == 'price'}">
                            Стоимость
                    </button>
                </div>
            </nav>
            <div class="tab-content">
                <div class="tab-pane" :class="{'show active': views.currentTab == 'general'}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content-line">
                                <strong>Название:</strong> {{ item.name }}

                                <button
                                    @click="views.editPanel = 'name'"
                                    class="btn-content-edit">
                                </button>

                                <ChangeName v-if="views.editPanel == 'name'" />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="tab-content-line">
                                <strong>Описание:</strong> {{ item.description ? item.description: '-' }}

                                <button
                                    @click="views.editPanel ='description'"
                                    class="btn-content-edit">
                                </button>

                                <ChangeCategory v-if="views.editPanel == 'description'" />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="tab-content-line">
                                <strong>Категория:</strong> {{ item.category_name }}

                                <button
                                    @click="views.editPanel ='category'"
                                    class="btn-content-edit">
                                </button>

                                <ChangeCategory v-if="views.editPanel == 'category'" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" :class="{'show active': views.currentTab == 'compatibility'}">
                    compatibility
                </div>

                <div class="tab-pane" :class="{'show active': views.currentTab == 'stock'}">
                    <StockTab :item="item" />
                </div>

                <div class="tab-pane" :class="{'show active': views.currentTab == 'price'}">
                    <div class="form-group">
                        <label class="form-label">Себестоимость Склад</label>
                        <input :value="stockPrice" type="number" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChangeName from './item/ChangeName.vue'
import ChangeCategory from './item/ChangeCategory.vue'
import StockTab from './StockTab.vue'

export default {
    data() {
        return {
            item: {},

            selected: {
                stockItems: [],
            },

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
    computed: {
        stockPrice() {
            if(this.selected.stockItems.length) {
                return this.selected.stockItems.reduce((n, {quantity, price}) => n + (quantity * price), 0)
            }
        }
    },
    methods: {
        loadItem() {
            axios.get(`/api/catalog-item/${this.$route.params.id}`)
            .then(response => {
                this.item = response.data.data

                this.views.loading = false
            })
        },
    },
    components: {
        ChangeName,
        ChangeCategory,
        StockTab,
    }
}
</script>