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
})

export default store
