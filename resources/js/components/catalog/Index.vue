<template>
    <div class="header">
        <div class="header-name">
            <h1>Каталог</h1>
        </div>

        <div class="header-buttons">
            <a href="#" class="btn btn-primary">Новая категория</a>
        </div>
    </div>

    <div class="content">
        <Loader v-if="views.loading" />

        <div v-if="!views.loading" class="content-folders">
            <div class="content-folder">
                <RouterLink :to="{name: 'CatalogBoxes'}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
                        <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                    
                    <span>
                        Корпуса
                    </span>
                </RouterLink>
            </div>

            <div v-for="category in categories" class="content-folder">
                <RouterLink :to="{name: 'CatalogCategory', params: {id: category.id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
                        <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                    
                    <span>
                        {{ category.name }}
                    </span>
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],

            views: {
                loading: true,
            },
        }
    },
    created() {
        this.loadCategories()
    },
    methods: {
        loadCategories() {
            axios.get('/api/catalog-categories')
            .then(response => {
                this.categories = response.data

                this.views.loading = false
            })
        },
    },
}
</script>