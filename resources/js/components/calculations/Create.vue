<template>
    <div class="header">
        <div class="header-name">
            <RouterLink
                :to="{name: 'Calculations'}"
                class="header-back-button">
            </RouterLink>

            <h1>Новый расчёт</h1>
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />
        
        <div v-if="!views.loading" class="calculation-creator">
            <div class="row">
                <div class="col-6">
                    {{ selected.box }}<br><br>
                    {{ selected.items }}
                </div>
                <div class="col-6">
                    <ul v-if="views.step == 'box'">
                        <li v-for="box in boxes">
                            {{ box.name }}, {{ box.pre_rub }}, {{ box.pre_usd }}, {{ box.price }}
                        </li>
                    </ul>

                    <template v-for="category in categories">
                        <div v-if="views.step == category.slug" class="calculation-creator-category">
                            {{ category.name }}
                            <ul>
                                <li v-for="item in category.items">
                                    {{ item }}
                                </li>
                            </ul>
                        </div>
                    </template>

                    <button @click="prevStep()">Назад</button>
                    <button @click="nextStep()">Далее</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            boxes: [],

            categories: [],

            selected: {
                box: '',
                catalogItems: '',
            },

            views: {
                step: 'box',
                loading: true,
            },
        }
    },
    created() {
        this.loadBoxes()
    },
    methods: {
        loadBoxes() {
            axios.get(`/api/catalog-boxes`)
            .then(response => {
                this.boxes = response.data.data

                this.loadCategories()
            })
        },
        loadCategories() {
            axios.get(`/api/catalog-categories`)
            .then(response => {
                this.categories = response.data

                this.views.loading = false
            })
        },
        loadCatalogItems(categoryID) {
            axios.get(`/api/catalog-category/${categoryID}`)
            .then(response => {
                this.categories.find(c => c.id == categoryID).items = response.data.items

                this.views.loading = false
            })
        },
        prevStep() {
            if(this.views.step == 'box') {
                return
            }

            let currentCategoryIndex = this.categories.findIndex(c => c.slug == this.views.step)
            let nextCategory = this.categories[currentCategoryIndex - 1]

            if(nextCategory) {
                this.views.step = nextCategory.slug
            }

            if(!nextCategory) {
                this.views.step = 'box'
            }
        },
        nextStep() {
            if(this.views.step == 'box') {
                this.views.step = this.categories[0].slug

                return this.loadCatalogItems(this.categories[0].id)
            }

            let currentCategoryIndex = this.categories.findIndex(c => c.slug == this.views.step)
            let nextCategory = this.categories[currentCategoryIndex + 1]

            if(nextCategory) {
                this.views.step = nextCategory.slug

                this.loadCatalogItems(this.categories.find(c => c.slug == nextCategory.slug).id)
            }
        },
    },
}
</script>