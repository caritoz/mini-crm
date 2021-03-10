<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-left">Add Transaction</h3>
                <div class="row">
                    <div class="col-md-6">
                        <form @submit.prevent="addTransaction" @keydown="errors.clear($event.target.name)">
                            <div class="form-group">
                                <label>Client</label>
                                <AutoComplete @receiveAutCompleteValue="handleAutoComplete"></AutoComplete>
                            </div>

                            <div class="form-group">
                                <label>Reference</label>
                                <input type="text" class="form-control" name="amount" v-model="transaction.reference">
                                <span class="help is-danger text-danger" v-if="errors.has('reference')" v-text="errors.get('reference')"></span>
                            </div>

                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" v-model="transaction.amount">
                                <span class="help is-danger text-danger" v-if="errors.has('amount')" v-text="errors.get('amount')"></span>
                            </div>

                            <button type="submit" class="btn btn-primary" :disabled="errors.any()">Add Transaction</button>
                            <router-link to="/transactions" class="btn btn-link">Cancel</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import AutoComplete from '../partials/AutoComplete'
    import {mapState} from "vuex";
    export default {
        name: "AddTransaction",
        components:{
            AutoComplete
        },
        computed: {
            ...mapState({
                errors: state => state.clients.errors
            })
        },
        data() {
            return {
                transaction: {},
                client_id: '',
            }
        },
        methods: {
            handleAutoComplete(elem){
                this.client_id = elem;
            },
            addTransaction(event){
                let data = new FormData(event.target);
                data.append('client_id', this.client_id);
                this.$store.dispatch('transactions/addTransaction', data);
            }
        }
    }
</script>
