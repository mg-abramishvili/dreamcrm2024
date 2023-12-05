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
                        @click="views.currentTab = 'type'"
                        :class="{'active': views.currentTab == 'type'}">
                            Тип
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

                        <div class="col-lg-12">
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
                    </div>
                </div>
                <div class="tab-pane" :class="{'show active': views.currentTab == 'type'}">
                    type
                </div>

                <div class="tab-pane" :class="{'show active': views.currentTab == 'stock'}">
                    <Stock :box="box" />
                </div>

                <div class="tab-pane" :class="{'show active': views.currentTab == 'price'}">
                    price
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChangeName from './box/ChangeName.vue'
import ChangeDescription from './box/ChangeDescription.vue'
import Stock from './box/Stock.vue'

export default {
    data() {
        return {
            box: {},

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
        Stock,
    }
}
</script>