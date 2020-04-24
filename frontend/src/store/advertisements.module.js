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
        },
        createAdvertisement({ commit, dispatch }, payload) {
            return localforage.getItem('authUser').then((headers) => {
                return axios.post(process.env.VUE_APP_API + `api/advertisements`, payload, {headers})
                    .then((response) => {
                        if (response.status === 201) {
                            dispatch('addNotification', {
                                type: 'success',
                                title: 'Pomyślnie dodano',
                                content: `Pomyślnie dodano ogłoszenie`
                            })
                            commit('SET_ADVERTISEMENT', response.data)
                        } else {
                            dispatch('addNotification', {
                                type: 'danger',
                                title: 'Błąd dodwania',
                                content: `Błędna odpowiedź serwera: ${response.status}`
                            })
                        }
                    })
                    .catch(error => {
                        dispatch('addNotification', {
                            type: 'danger',
                            title: 'Błąd dodawania',
                            content: `Błędna odpowiedź serwera: ${error.response.data.message}`
                        })
                    })
            })
        },
        updateAdvertisement({ commit, dispatch }, payload) {
            return localforage.getItem('authUser').then((headers) => {
                return axios.put(process.env.VUE_APP_API + `api/advertisements/${payload.id}`, payload, {headers})
                    .then((response) => {
                        if (response.status === 200) {
                            dispatch('addNotification', {
                                type: 'success',
                                title: 'Pomyślnie zapisano',
                                content: `Pomyślnie zapisano ogłoszenie`
                            })
                            commit('SET_ADVERTISEMENT', response.data)
                        } else {
                            dispatch('addNotification', {
                                type: 'danger',
                                title: 'Błąd dodwania',
                                content: `Błędna odpowiedź serwera: ${response.status}`
                            })
                        }
                    })
                    .catch(error => {
                        dispatch('addNotification', {
                            type: 'danger',
                            title: 'Błąd dodawania',
                            content: `Błędna odpowiedź serwera: ${error.response.data.message}`
                        })
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
