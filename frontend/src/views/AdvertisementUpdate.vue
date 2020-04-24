<template>
    <div class="login-form">
        <form @submit.prevent="create" method="post">
            <div class="avatar"><i class="material-icons">&#xe616;</i></div>
            <h4 class="modal-title">Edytuj ogłoszenie</h4>
            <div class="form-group">
                <field-input v-model="advertisement.title" :error="errors.title" label="Tytuł"></field-input>
            </div>
            <div class="form-group">
                <field-textarea v-model="advertisement.description" :error="errors.description" label="Opis"></field-textarea>
            </div>
            <div class="form-group">
                <field-input v-model="advertisement.quantity" :error="errors.quantity" label="Ilość"></field-input>
            </div>
            <div class="form-group">
                <field-input v-model="advertisement.price" :error="errors.price" label="Cena"></field-input>
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Zapisz">
        </form>
    </div>
</template>

<script>
    import '../assets/login_register.css'
    import FieldInput from '../components/InputField'
    import TextareaField from '../components/TextareaField'
    import localforage from 'localforage'

    export default {
        data() {
            return {
                errors: {
                    title: false,
                    description: false,
                    quantity: false,
                    price: false,
                }
            }
        },
        components: {
            'field-input': FieldInput,
            'field-textarea': TextareaField
        },
        computed: {
            advertisement(){
                return this.$store.getters.getAdvertisement
            },
        },
        methods: {
            validate(){
                if (this.advertisement.title == '' ||
                    this.advertisement.description == '' ||
                    this.advertisement.quantity == '' ||
                    this.advertisement.price == ''
                ) {
                    this.advertisement.title == '' ? this.errors.title = true : null;
                    this.advertisement.description == '' ? this.errors.description = true : null;
                    this.advertisement.quantity == '' ? this.errors.quantity = true : null;
                    this.advertisement.price == '' ? this.errors.price = true : null;


                    this.$store.dispatch('addNotification', {
                        type: 'danger',
                        title: 'Błąd',
                        content: 'Uzupełnij wszystkie pola'
                    })
                    return true
                }
            },
            create(){
                if (this.validate()) {
                    return
                }

                const postData ={
                    id: this.advertisement.id,
                    title: this.advertisement.title,
                    description: this.advertisement.description,
                    quantity: this.advertisement.quantity,
                    price: this.advertisement.price,
                    user_id: this.advertisement.user_id
                }

                console.log(postData)

                this.$store.dispatch('updateAdvertisement', postData)

                this.$router.push({name: 'advertisements'})
            },
        },
        created(){
            this.$store.dispatch('fetchAdvertisement', { id: this.$route.params.id })
            localforage.getItem('user').then((user) => {
                this.advertisement.user_id = user.user_id
            })
        }
    }
</script>