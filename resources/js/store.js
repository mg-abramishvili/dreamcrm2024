import { createStore } from 'vuex'

const store = createStore({
    state() {
        return {
            user: {},

            usdKurs: null,
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user
        },
        setUsdKurs(state, kurs) {
            state.usdKurs = kurs
        },
    },
    getters: {
        userHasPermission: (state) => (permission, level) => {
            let userPermissions = state.user.permissions

            return !!(userPermissions && userPermissions[permission + '_' + level])
        },
    }
})

export default store
