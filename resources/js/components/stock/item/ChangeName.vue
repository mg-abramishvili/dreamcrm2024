<template>
    <div class="offcanvas offcanvas-end show" tabindex="-1" id="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Название</h5>
            <button type="button" class="btn-close" @click="$parent.views.editPanel = ''"></button>
        </div>
        <div class="offcanvas-body">
            <input type="text" v-model="name" class="form-control">

            <button @click="save()" class="btn btn-primary mt-2">Сохранить</button>
        </div>
    </div>

    <div @click="$parent.views.editPanel = ''" class="offcanvas-backdrop fade show"></div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
        }
    },
    created() {
        this.name = this.$parent.item.name
    },
    methods: {
        save() {
            if(!this.name) {
                return this.$toast.error("Укажите название")
            }

            axios.put(`/api/stock-item/${this.$parent.item.id}/update`, {
                name: this.name
            })
            .then(response => {
                this.$parent.loadItem()

                this.$parent.views.editPanel = ''
            })
            .catch(errors => {
                return this.$toast.error(errors)
            })
        },
    },
}
</script>
