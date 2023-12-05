<template>
    <div class="offcanvas offcanvas-end show" tabindex="-1" id="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Категория</h5>
            <button type="button" class="btn-close" @click="$parent.views.editPanel = ''"></button>
        </div>
        <div class="offcanvas-body">
            <Loader v-if="views.loading" />
        
            <select v-if="!views.loading" v-model="selected.category" class="form-select">
                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
        
            <button v-if="!views.loading" @click="save()" class="btn btn-primary mt-2">Сохранить</button>
        </div>
    </div>

    <div @click="$parent.views.editPanel = ''" class="offcanvas-backdrop fade show"></div>
</template>

<script>
export default {
    data() {
        return {
            selected: {
                category: '',
            },

            views: {
                loading: true,
            }
        }
    },
    created() {
        this.loadCategories()
    },
    methods: {
        loadCategories() {
            axios.get('/api/stock-categories')
            .then(response => {
                this.categories = response.data

                this.selected.category = this.$parent.item.category_id

                this.views.loading = false
            })
        },
        save() {
            console.log(this.newName)

            this.$parent.views.editPanel = ''
        }
    },
}
</script>