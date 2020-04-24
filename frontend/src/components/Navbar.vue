<template>
    <nav v-if="showMenu" class="navbar navbar-expand-lg navbar-dark bg-green">
        <a class="navbar-brand" href="#">Laravel/Vue</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li v-bind:key="id" v-for="(item, id) in menu" class="nav-item">
                    <a class="nav-link" @click="$router.push({name: item.name})" href="javascript:void(0)">{{ item.label }}</a>
                </li>
                <li  class="nav-item">
                    <a href="/logout" class="nav-link">
                        Wyloguj się
                    </a>
                </li>
            </ul>
        </div>

    </nav>
</template>

<script>
    import localforage from 'localforage'

    export default {
        data(){
            return {
                menu: [
                    {
                        name: 'advertisements',
                        label: 'Ogłoszenia'
                    }
                ],
                showMenu: true
            }
        },
        created() {
            localforage.getItem('user').then((data) => {
                if (!data) {
                    this.showMenu = false
                }
            })
        }
    }
</script>