<template>
    <div class="header">
        <h1>Расчёты</h1>

        <div class="header-buttons">
            <a href="#" class="btn btn-primary">Новый расчёт</a>
        </div>
    </div>

    <SearchPanel />

    <div class="content">
        <div class="content-table">
        </div>
    </div>
</template>

<script>
import SearchPanel from './SearchPanel.vue'

export default {
    components: {
        SearchPanel
    }
}
</script>