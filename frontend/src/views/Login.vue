<template>
    <div class="login-form">
        <form @submit.prevent="handleLoginFormSubmit" method="post">
            <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
            <h4 class="modal-title">Zaloguj się</h4>
            <div class="form-group">
                <field-input v-model="login.email" :error="errors.email" label="E-mail"></field-input>
            </div>
            <div class="form-group">
                <field-input v-model="login.password" type="password" :error="errors.password" label="Hasło"></field-input>
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Zaloguj się">
        </form>
        <div class="text-center small">Nie masz konta? <a @click="$router.push('register')" href="javascript:void(0)">Zarejestruj się</a></div>
    </div>
</template>

<script>
    import axios from 'axios'
    import localforage from 'localforage'
    import '../assets/login_register.css';
    import FieldInput from '../components/InputField'

    export default {
        data() {
            return {
                login: {
                    email: '',
                    password: '',
                },
                userId: null,
                errors: {
                    email: false,
                    password: false
                }
            }
        },
        components: {
            FieldInput,
            'field-input': FieldInput
        },
        methods: {
            validate(){
                if (this.login.email == '' || this.login.password == '') {
                    this.login.email == '' ? this.errors.email = true : null;
                    this.login.password == '' ? this.errors.password = true : null;


                    this.$store.dispatch('addNotification', {
                        type: 'danger',
                        title: 'Błąd',
                        content: 'Uzupełnij wszystkie pola'
                    })
                    return true
                }
            },
            handleLoginFormSubmit(){
                if (this.validate()) {
                    return
                }

                const postData ={
                    email: this.login.email,
                    password: this.login.password
                }
                axios.post(process.env.VUE_APP_API+'api/auth/login', postData, {
                    'Content-Type': 'multipart/form-data'
                })
                    .then(response => {
                        if(response.status === 200){
                            if(response.data.access_token){
                                const headers = {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                    'Authorization': 'Bearer ' + response.data.access_token
                                }

                                localforage.setItem('authUser', headers).then(() => {
                                    localforage.setItem('user', response.data)
                                    this.$router.go({name:'advertisements'})
                                })
                            }
                        } else {
                            this.$store.dispatch('addNotification', {
                                type: 'danger',
                                title: 'Błąd logowania',
                                content: `Błędna odpowiedź serwera: ${response.status}`
                            })
                        }
                    })
                    .catch(error => {
                        if(error.response && error.response.status === 422){
                            this.$store.dispatch('addNotification', {
                                type: 'danger',
                                title: 'Błąd logowania',
                                content: error.response.data.message
                            })
                        } else {
                            this.$store.dispatch('addNotification', {
                                type: 'danger',
                                title: 'Błąd logowania',
                                content: `Błędna odpowiedź serwera: ${error}`
                            })
                        }
                    })
            },
        }
    }
</script>