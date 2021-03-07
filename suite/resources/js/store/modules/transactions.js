import store from '../../store'
import { Errors, EventBus } from "../../event-bus";
import router from "../../router";

// initial state
const state = () => ({
    all: {},
    entity: {},
    errors: new Errors()
})

const mutations = {
    SET_CLEAR_ERRORS(state){
        state.errors.clearAll()
    },
    SET_TRANSACTIONS (state, transactions) {
        state.all = transactions
    },
    UPDATE_TRANSACTIONS(state, entity){
        let transactions = [...state.all.data];
        const index = transactions.findIndex(t => t.id === entity.id);
        if(index !== -1) {
            transactions.splice(index, 0);
        }
        state.all.data = [...transactions];
    },
    SET_DELETE (state, entity) {
        let transactions = [...state.all.data];
        const index = transactions.findIndex(t => t.id === entity.id);
        // const index = transactions.findIndex(function (value) { return value.id === entity.id; });
        if(index !== -1) {
            transactions.splice(index, 1);
        }
        state.all.data = [...transactions];
    },
}

const getters = {
    transactions: state => {
        return state.transactions
    },
    entity: state => {
        return state.entity
    }
}

const actions = {
    fetchTransactions ({ commit }, data) {
        let urlPath = '/auth/transactions'
        let query = ''
        if( data ){
            // urlPath = `${urlPath}?page=${data.page}`
            query = `?page=${data.page}`;
            if(data.client_id)
            {
                query += `&client_id=${data.client_id}`;
                store.dispatch('clients/findClient', data.client_id)
                //commit('clients/findClient', data.client_id)
            }
        }
        urlPath = `${urlPath}${query}`
        axios.get(urlPath)
            .then(res => {
                {
                    //console.log(res.data)
                    commit('SET_TRANSACTIONS', res.data)
                }
            })
            .catch(err => {
                if(err.response !== undefined && ( err.response.status !== 200 ) )
                {
                    // console.error(err.response.data.message)
                    EventBus.$emit('flash-message', err.response.data.message, 'ERROR');
                }
            })
    },
    readTransaction({commit}, transaction){
        commit('SET_CLEAR_ERRORS')
        EventBus.$emit('modal-entity', { 'header': transaction.full_name, 'body': '$'+transaction.amount });
    },
    deleteTransaction({commit}, transaction){
        axios.delete(`/auth/transactions/${transaction.id}`)
            .then(response => {
                // console.log(response.data);
                if(response.status === 200){
                    EventBus.$emit('flash-message', 'The transaction was deleted.', 'SUCCESS');
                    commit('SET_DELETE', response.data)
                }
            })
            .catch(error => {
                if(error.response !== undefined && ( error.response.status !== 200 ) )
                {
                    // console.error(error.response.data.message)
                    EventBus.$emit('flash-message', error.response.data.message, 'ERROR');
                }
            })
    },
    addTransaction({commit}, data){
        commit('SET_CLEAR_ERRORS')
        axios.post('/auth/transactions', data)
            .then( response => {
                if(response.status === 200){
                    EventBus.$emit('flash-message', 'The transaction was added.', 'SUCCESS');
                    commit('UPDATE_TRANSACTIONS', response.data);
                }

                router.push({name: 'Transactions'});
            })
            .catch(error => {
                if(error.response !== undefined && error.response.status === 422)
                {
                    commit('SET_ERRORS', error.response.data.errors);
                }
                else if(error.response !== undefined && ( error.response.status !== 200 ) )
                {
                    EventBus.$emit('flash-message', error.response.data.message, 'ERROR');
                }
            })
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
