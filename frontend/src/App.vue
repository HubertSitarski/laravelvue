<template>
  <div>
    <navbar></navbar>
    <notification></notification>
    <div class="container-fluid">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Navbar from './components/Navbar'
import Notification from './components/Notification'
import './assets/main.css';

export default {
    name: 'App',
    components: {
        'navbar': Navbar,
        'notification': Notification
    }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
