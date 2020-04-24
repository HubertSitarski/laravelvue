<template>
    <div class="login-form">
        <form @submit.prevent="handleRegister" method="post">
            <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
            <h4 class="modal-title">Zarejestruj się</h4>
            <div class="form-group">
                <field-input v-model="register.name" :error="errors.name" label="Imię i nazwisko"></field-input>
            </div>
            <div class="form-group">
                <field-input v-model="register.email" :error="errors.email" label="E-mail"></field-input>
            </div>
            <div class="form-group">
                <field-input v-model="register.password" type="password" :error="errors.password" label="Hasło"></field-input>
            </div>
            <div class="form-group">
                <field-input v-model="register.password_confirmation" type="password" :error="errors.password_confirmation" label="Powtórz hasło"></field-input>
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Zarejestruj się">
        </form>
        <div class="text-center small">Posiadasz już konto? <a @click="$router.push({name: 'login'})" href="javascript:void(0)">Zaloguj się</a></div>
    </div>
</template>

<script>
    import axios from 'axios'
    import '../assets/login_register.css';
    import FieldInput from '../components/InputField'

    export default {
        data() {
            return {
                register: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: {
                    name: false,
                    email: false,
                    password: false,
                    password_confirmation: false
                }
            }
        },
        components: {
            'field-input': FieldInput
        },
        methods: {
            validate(){
                if (this.register.email == '' ||
                    this.register.password == '' ||
                    this.register.password_confirmation == '' ||
                    this.register.name == ''
                ) {
                    this.register.email == '' ? this.errors.email = true : null;
                    this.register.password == '' ? this.errors.password = true : null;
                    this.register.password_confirmation == '' ? this.errors.password_confirmation = true : null;
                    this.register.name == '' ? this.errors.name = true : null;


                    this.$store.dispatch('addNotification', {
                        type: 'danger',
                        title: 'Błąd',
                        content: 'Uzupełnij wszystkie pola'
                    })
                    return true
                }

                if (this.register.password != this.register.password_confirmation) {
                    this.$store.dispatch('addNotification', {
                        type: 'danger',
                        title: 'Błąd',
                        content: 'Hasła nie są takie same'
                    })
                    return true
                }
            },
            handleRegister(){
                if (this.validate()) {
                    return
                }

                const postData ={
                    name: this.register.name,
                    email: this.register.email,
                    password: this.register.password,
                    password_confirmation: this.register.password_confirmation
                }
                axios.post(process.env.VUE_APP_API+'api/auth/register', postData, {
                    'Content-Type': 'application/json'
                })
                    .then(response => {
                        if(response.status === 201){
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                title: 'Pomyślnie zarejestrowano',
                                content: `Pomyślnie zarejestrowano użytkownika`
                            })
                            this.$router.push({name: 'login'})
                        } else {
                            this.$store.dispatch('addNotification', {
                                type: 'danger',
                                title: 'Błąd rejestracji',
                                content: `Błędna odpowiedź serwera: ${response.status}`
                            })
                        }
                    })
                    .catch(error => {
                        this.$store.dispatch('addNotification', {
                                type: 'danger',
                                title: 'Błąd rejestracji',
                                content: `Błędna odpowiedź serwera: ${error.response.data.message}`
                        })
                    })
            },
        }
    }
</script>