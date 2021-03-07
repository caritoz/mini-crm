<template>
    <div class="container dashboard">
        <div class="row">
            <div class="col-md-12">
                <h1 v-if="authenticated">{{ user.name }}, This is an dashboard</h1>
                <div>
                    <span>We're champions!!!</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import Vue from 'vue'
// Vue.component('posts', require('./components/Posts.vue'))
// import Posts from '@/components/Posts.vue'

import { mapGetters } from 'vuex'

export default {
  name: 'Dashboard',
  components: {

  },
  computed: {
    ...mapGetters({
      authenticated: 'auth/authenticated',
      user: 'auth/user',
    })
  }
}
</script>
