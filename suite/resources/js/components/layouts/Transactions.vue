<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3 class="display-4 text-left">Transactions</h3>
            </div>
            <div class="col-md-9">
                <div class="text-right">
                    <template v-if="show">
                        <span>{{client.full_name}}</span><a href="#" @click="clickHandler" class="btn btn-link float-right" v-if="client"><< Back</a>
                    </template>
                    <template v-else>
                        <span class="text-right"><router-link to="/transactions/add" class="nav-item nav-link">Add ++</router-link></span>
                    </template>
                </div>
            </div>
            <div class="col-md-12">
                <ListTransaction/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapState} from 'vuex'
    import ListTransaction from '../transactions/ListTransaction'
    import router from "../../router";
    export default {
        name: "Transactions",
        mounted() {
            this.hasClient()
        },
        data() {
            return {
                show: false,
            }
        },
        components: {
            ListTransaction
        },
        computed: {
            ...mapGetters({
                client: 'clients/entity',
            })
        },
        methods: {
            hasClient(){
                let _client_id = this.$route.params.id;
                this.show = (_client_id !== undefined);
            },
            clickHandler(){
                // this.client = undefined;
                router.push({name: 'Clients'});
            }
        }
    }
</script>
