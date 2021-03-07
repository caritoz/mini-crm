<template>
    <div>
        <div>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client</th>
                        <th scope="col">Transaction date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">@</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="transaction in transactions.data" :key="'number' + transaction.id">
                        <th scope="row">{{transaction.id}}</th>
                        <td class="text-left">{{ transaction.full_name }}</td>
                        <td>{{ transaction.transaction_date }}</td>
                        <td>{{ transaction.amount }}</td>
                        <td><a @click="showTransaction(transaction)" class="btn btn-link float-left"><b-icon icon="eye-fill"></b-icon></a>
                            <a @click="deleteTransaction(transaction)" class="btn btn-link float-left"><b-icon icon="trash"></b-icon> </a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <pagination :data="transactions" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        name: "ListTransaction",
        computed: mapState({
            transactions: state => state.transactions.all
        }),
        created() {
            this.getResults()
        },
        methods: {
            getResults(_page ){
                let _client_id = this.$route.params.id;
                if( typeof _client_id === 'undefined' )
                {
                    _client_id = null;
                }
                if (typeof _page === 'undefined') {
                    _page = 1;
                }

                this.$store.dispatch('transactions/fetchTransactions', {
                    page: _page,
                    client_id: _client_id
                })
            },
            showTransaction(entity){
                this.$store.dispatch('transactions/readTransaction', entity)
            },
            deleteTransaction(entity){
                if( confirm('Are you sure?') )
                {
                    this.$store.dispatch('transactions/deleteTransaction', entity)
                }
            }
        }
    }
</script>

<style scoped>

</style>
