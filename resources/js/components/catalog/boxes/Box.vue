<template>
    <div class="header">
        <div class="header-name">
            <RouterLink
                :to="{name: 'CatalogBoxes'}"
                class="header-back-button">
            </RouterLink>

            <h1>{{ box.name }}</h1>
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
                                <strong>Название:</strong>
                                {{ box.name }}

                                <button
                                    @click="views.editPanel = 'name'"
                                    class="btn-content-edit">
                                </button>

                                <ChangeName v-if="views.editPanel == 'name'" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content-line">
                                <strong>Описание:</strong>
                                {{ box.description ? box.description: '-' }}
    
                                <button
                                    @click="views.editPanel ='description'"
                                    class="btn-content-edit">
                                </button>
    
                                <ChangeDescription v-if="views.editPanel == 'description'" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content-line">
                                <strong>Описание для менеджеров:</strong>
                                {{ box.manager_description ? box.manager_description: '-' }}
    
                                <button
                                    @click="views.editPanel ='description'"
                                    class="btn-content-edit">
                                </button>
    
                                <ChangeDescription v-if="views.editPanel == 'description'" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content-line">
                                <strong>Комментарий:</strong>
                                {{ box.comment ? box.comment: '-' }}
    
                                <button
                                    @click="views.editPanel ='description'"
                                    class="btn-content-edit">
                                </button>
    
                                <ChangeDescription v-if="views.editPanel == 'description'" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content-line">
                                <strong>Глубина, мм:</strong>
                                {{ box.length ? box.length: '-' }}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content-line">
                                <strong>Ширина, мм:</strong>
                                {{ box.width ? box.width: '-' }}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content-line">
                                <strong>Высота, мм:</strong>
                                {{ box.height ? box.height: '-' }}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content-line">
                                <strong>Вес, кг:</strong>
                                {{ box.weight ? box.weight: '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" :class="{'show active': views.currentTab == 'stock'}">
                    <StockTab :box="box" />
                </div>

                <div class="tab-pane" :class="{'show active': views.currentTab == 'price'}">
                    <div class="form-group">
                        <label class="form-label">Себестоимость Склад</label>
                        <input :value="stockPrice" type="number" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Себестоимость Сборка</label>
                        <input type="number" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChangeName from './box/ChangeName.vue'
import ChangeDescription from './box/ChangeDescription.vue'
import StockTab from './../StockTab.vue'

export default {
    data() {
        return {
            box: {},

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
        this.loadBox()
    },
    computed: {
        stockPrice() {
            if(this.selected.stockItems.length) {
                return this.selected.stockItems.reduce((n, {quantity, price}) => n + (quantity * price), 0)
            }
        }
    },
    methods: {
        loadBox() {
            axios.get(`/api/catalog-box/${this.$route.params.id}`)
            .then(response => {
                this.box = response.data.data

                this.views.loading = false
            })
        },
    },
    components: {
        ChangeName,
        ChangeDescription,
        StockTab,
    }
}
</script>