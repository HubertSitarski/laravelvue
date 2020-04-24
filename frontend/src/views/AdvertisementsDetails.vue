<template>
    <div v-if="advertisement" class="container">
        <div class="row text-center">
            <div class="col-12 details-back">
                <span @click="$router.push({name: 'advertisements'})" class="material-icons details-back-icon">
                    arrow_back
                </span>
            </div>
            <br>
            <div class="col-12 details-title">
                <h4>{{ advertisement.title }}</h4>
            </div>
            <div class="col-12 details-description">
                {{ advertisement.description }}
            </div>
            <br>
            <div class="col-12 details-column">
                <b>Ilość: </b>{{ advertisement.quantity }}
            </div>
            <div class="col-12 details-column">
                <h2>{{ advertisement.price }} zł</h2>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'advertisements-details',
        computed: {
            advertisement(){
                return this.$store.getters.getAdvertisement
            },
        },
        created(){
            this.$store.dispatch('fetchAdvertisement', { id: this.$route.params.id })
        }
    }
</script>