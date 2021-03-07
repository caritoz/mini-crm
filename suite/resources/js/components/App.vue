<template>
    <div id="app">
        <Navigation/>
        <main class="py-4">
            <flash-message></flash-message>

            <!-- use the modal component, pass in the prop -->
            <modal-entity></modal-entity>

            <router-view/>
        </main>
    </div>
</template>

<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>

<script>
import Navigation from './partials/Navigation';
import ModalEntity from './partials/ModalEntity';
export default {
  components: {
    Navigation,
    ModalEntity
  }
}
</script>
