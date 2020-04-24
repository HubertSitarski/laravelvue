<template>
    <div v-if="advertisements" class="container">
        <br>
        <button @click="$router.push({name: 'advertisements-create'})" class="btn btn-success">
            Dodaj
        </button>
        <br>
        <br>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Wystawiający</th>
                        <th scope="col">Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-bind:key="advertisement.id" v-for="advertisement in advertisements">
                        <th scope="row">
                            <a class="list-link" href="javascript:void(0)" @click="$router.push({ name: 'advertisements-details', params: { id: advertisement.id }})">{{ advertisement.title}}</a>
                        </th>
                        <td>{{ advertisement.quantity }}</td>
                        <td>{{ advertisement.price }}</td>
                        <td>{{ advertisement.user.name }}</td>
                        <td>
                            <span @click="$router.push({ name: 'advertisements-edit', params: { id: advertisement.id }})" class="material-icons">
                                edit
                            </span>
                            <span @click="remove(advertisement)" class="material-icons">
                                delete
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'advertisements',
        computed: {
            advertisements(){
                return this.$store.getters.getAdvertisements
            },
        },
        methods: {
            remove(advertisement){
                this.$store.dispatch('removeAdvertisement', { id: advertisement.id })
            }
        },
        created(){
            this.$store.dispatch('fetchAdvertisements')
        }
    }
</script>