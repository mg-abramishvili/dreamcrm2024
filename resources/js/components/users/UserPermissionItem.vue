<template>
    <div class="row align-items-center mb-4">
        <div class="col-3">
            {{ permissionTitle }}
        </div>
        <div class="col-9">
            <div class="form-check form-check-inline form-switch me-4">
                <input v-model="canWatch" @change="save()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Просмотр</label>
            </div>

            <div class="form-check form-check-inline form-switch me-4">
                <input v-model="canCreate" @change="save()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Редактирование</label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['permission', 'permissionTitle'],
    data() {
        return {
            canWatch: false,
            canCreate: false,
        }
    },
    created() {
        let userPermissions = this.$store.state.user.permissions

        this.canWatch = !!userPermissions[this.permission + '_watch']
        this.canCreate = !!userPermissions[this.permission + '_create']
    },
    methods: {
        save() {
            axios.put(`/api/user/${this.$store.state.user.id}/permissions-update`, {
                permission: this.permission,
                can_watch: this.canWatch,
                can_create: this.canCreate,
            })
            .then(response => {
                this.$toast.success('Права обновлены')

                setTimeout(window.location.reload.bind(window.location), 500)
            })
            .catch(errors => {
                return this.$toast.error(errors)
            })
        },
    }
}
</script>
