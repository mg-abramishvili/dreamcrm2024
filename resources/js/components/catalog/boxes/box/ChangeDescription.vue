<template>
    <div class="offcanvas offcanvas-end show" tabindex="-1" id="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Описание</h5>
            <button type="button" class="btn-close" @click="$parent.views.editPanel = ''"></button>
        </div>
        <div class="offcanvas-body">
            <textarea v-model="description" class="form-control"></textarea>
        
            <button @click="save()" class="btn btn-primary mt-2">Сохранить</button>
        </div>
    </div>

    <div @click="$parent.views.editPanel = ''" class="offcanvas-backdrop fade show"></div>
</template>

<script>
export default {
    data() {
        return {
            description: '',
        }
    },
    created() {
        this.description = this.$parent.box.description
    },
    methods: {
        save() {
            this.$parent.views.editPanel = ''
        }
    },
}
</script>