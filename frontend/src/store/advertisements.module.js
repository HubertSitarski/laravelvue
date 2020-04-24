import localforage from 'localforage'
import axios from 'axios'

export const advertisements = {
    state: {
        advertisements: [],
        advertisement: null,
    },
    mutations: {
        SET_ADVERTISEMENTS(state, content) {
            state.advertisements = content
        },
        SET_ADVERTISEMENT(state, content) {
            state.advertisement = content
        }
    },
    actions: {
        fetchAdvertisements({ commit }) {
            return localforage.getItem('authUser').then((headers) => {
                return axios.get( process.env.VUE_APP_API+'api/advertisements', { headers })
                    .then((response) => {
                        commit('SET_ADVERTISEMENTS', response.data)
                    })
                    .catch((e) => {
                        console.error(e);
                    })
            })
        },
        fetchAdvertisement({ commit }, payload) {
            return localforage.getItem('authUser').then((headers) => {
                return axios.get( process.env.VUE_APP_API+`api/advertisements/${payload.id}`, { headers })
                    .then((response) => {
                        commit('SET_ADVERTISEMENT', response.data)
                    })
                    .catch((e) => {
                        console.error(e);
                    })
            })
        },
        removeAdvertisement({ commit }, payload) {
            return localforage.getItem('authUser').then((headers) => {
                return axios.delete( process.env.VUE_APP_API+`api/advertisements/${payload.id}`, { headers })
                    .then(() => {
                        axios.get( process.env.VUE_APP_API+'api/advertisements', { headers })
                            .then((response) => {
                                commit('SET_ADVERTISEMENTS', response.data)
                            })
                            .catch((e) => {
                                console.error(e);
                            })
                    })
                    .catch((e) => {
                        console.error(e);
                    })
            })
        }
    },
    getters: {
        getAdvertisements: (state) => {
            if(state.advertisements){
                return state.advertisements
            }
        },
        getAdvertisement: (state) => {
            if(state.advertisement){
                return state.advertisement
            }
        }
    }
}
