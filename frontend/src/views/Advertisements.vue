<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Wystawiający</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-bind:key="advertisement.id" v-for="advertisement in advertisements">
                        <th scope="row">{{ advertisement.title}}</th>
                        <td>{{ advertisement.quantity }}</td>
                        <td>{{ advertisement.price }}</td>
                        <td>{{ advertisement.user.name }}</td>
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
        created(){
            this.$store.dispatch('fetchAdvertisements')
        }
    }
</script>