<template>
    <nav id="nav" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="navbar-brand"  to="/">Laravel</router-link>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/home"><span>Home</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/about"><span>About</span></router-link>
                    </li>
                    <template v-if="authenticated">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/dashboard"><span>Dashboard</span></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/clients"><span>Clients</span></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/transactions"><span>Transactions</span></router-link>
                        </li>
                    </template>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <template v-if="authenticated">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ user.name }}</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/" @click.prevent="signOut">Logout</a>
                            </div>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/login"><span>Login</span></router-link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import {mapGetters, mapActions, mapState} from 'vuex'
export default {
    name: "Navigation",
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        })
    },
    methods: {
        ...mapActions({
            signOutAction: 'auth/signOut'
        }),
        signOut(){
            this.signOutAction().then( () => {
                this.$router.replace({
                    name: 'Home'
                })
            })
        }
    }
}
</script>

<style scoped></style>
