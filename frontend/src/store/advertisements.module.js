import localforage from 'localforage'
import axios from 'axios'

export const advertisements = {
    state: {
        advertisements: null,
    },
    mutations: {
        SET_ADVERTISEMENTS(state, content) {
            state.advertisements = content
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
        }
    },
    getters: {
        getAdvertisements: (state) => {
            if(state.advertisements){
                return state.advertisements
            }
        }
    }
}
