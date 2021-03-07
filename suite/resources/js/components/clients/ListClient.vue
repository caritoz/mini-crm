<template>
    <div>
        <div>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Email</th>
                        <th scope="col">Transactions</th>
                        <th scope="col">@</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in clients.data" :key="'number' + client.id">
                        <th scope="row">{{client.id}}</th>
                        <td>{{ client.first_name }}</td>
                        <td>{{ client.last_name }}</td>
                        <td>{{ client.email }}</td>
                        <td class="text-center">
                            <router-link :to="{name: 'Transactions', params: { id: client.id }}" class="btn btn-link float-left">{{ client.amount_transactions }}</router-link>
                        </td>
                        <td>
                            <a @click="showClient(client)" class="btn btn-link float-left"><b-icon icon="eye-fill"></b-icon></a>
                            <router-link :to="{name: 'EditClient', params: { id: client.id }}" class="btn btn-link float-left"><b-icon icon="pencil-square"></b-icon> </router-link>
                            <a @click="deleteClient(client)" class="btn btn-link float-left"><b-icon icon="trash"></b-icon> </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <pagination :data="clients" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    export default {
        computed: mapState({
            clients: state => state.clients.all
        }),
        created () {
            this.getResults()
        },
        methods: {
            showClient(entity) {
                this.$store.dispatch('clients/showClient', entity)
            },
            deleteClient(entity) {
                if( confirm('Are you sure?') )
                {
                    this.$store.dispatch('clients/deleteClient', entity)
                }
            },
            getResults(_page) {
                if (typeof _page === 'undefined') {
                    _page = 1;
                }
                this.$store.dispatch('clients/fetchResults', {
                    page: _page
                })
            }
        },
    }
</script>
