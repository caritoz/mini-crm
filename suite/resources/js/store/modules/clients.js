import router from '../../router'
import { Errors, EventBus } from "../../event-bus";

const config = {
    headers: { 'content-type': 'multipart/form-data' }
}

// initial state
const state = () => ({
    all: {},
    entity: {},
    errors: new Errors()
})

// mutations
const mutations = {
    SET_CLIENTS (state, clients) {
        state.all = clients
    },
    SET_CLIENT (state, entity) {
        state.entity = entity
    },
    SET_DELETE (state, entity) {
        let clients = [...state.all.data];
        const index = clients.findIndex(t => t.id === entity.id);
        // const index = clients.findIndex(function (value) { return value.id === entity.id; });
        if(index !== -1) {
            clients.splice(index, 1);
        }
        state.all.data = [...clients];
    },
    UPDATE_CLIENTS(state, entity){
        // const alt = state.all.data.find(entity => entity.id === id)
        let clients = [...state.all.data];
        const index = clients.findIndex(t => t.id === entity.id);
        if(index !== -1) {
            // clients.splice(index, 0, entity);
            clients.splice(index, 0);
        }
        state.all.data = [...clients];
    },
    SET_CLEAR_ERRORS(state){
        state.errors.clearAll()
    },
    SET_ERRORS(state, validationErrors){
        // state.errors = validationErrors;
        state.errors.record(validationErrors)
    },
    findClient(state, id){
        let clients = [...state.all.data];
        const index = clients.findIndex(t => t.id === id);
        state.entity = clients[index]
    },
    updateFirstName(state, value){
        state.entity.first_name = value
    },
    updateLastName(state, value){
        state.entity.last_name = value
    },
    updateEmail(state, value){
        state.entity.email = value
    },
    updateAvatar(state, value){
        state.entity.avatar = value
    }
}

// getters
const getters = {
    clients: state => {
        return state.clients
    },
    entity: state => {
        return state.entity
    }
}

// actions
const actions = {
    fetchResults ({ commit }, data) {
        let urlPath = '/auth/clients'
        if( data ){
            urlPath = `${urlPath}?page=${data.page}`
        }
        axios.get(urlPath)
            .then(res => {
                {
                    //console.log(res.data)
                    commit('SET_CLIENTS', res.data)
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
    addClient({ commit }, data){
        commit('SET_CLEAR_ERRORS')
        axios.post('/auth/clients', data, config)
            .then(response => {
                commit('SET_CLEAR_ERRORS')
                if(response !== undefined && response.status === 201)
                {
                    EventBus.$emit('flash-message', 'The client was added.', 'SUCCESS');
                    commit('UPDATE_CLIENTS', response.data);
                }
                // redirect after updated
                router.push({name: 'Clients'});
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
    },
    showClient({commit}, client){
        let header  = client.full_name;
        let body    = { 'data': [ {'email' : client.email , 'transactions' : client.amount_transactions, 'img': client.full_path_avatar} ] }  ;
        EventBus.$emit('modal-entity', { 'header': header, 'body': body });
    },
    editClient({commit}, client){
        commit('SET_CLEAR_ERRORS')
        axios.get(`/auth/clients/${client.id}`)
            .then(response => {
                // console.log(response.data);
                if(response.status === 200)
                {
                    commit('SET_CLIENT', response.data)
                }
            })
            .catch(error => {
                if(error.response !== undefined && ( error.response.status !== 200 ) ){
                    // console.error(error.response.data.message)
                    EventBus.$emit('flash-message', error.response.data.message, 'ERROR');
                }
            })
    },
    deleteClient({commit}, client){
        axios.delete(`/auth/clients/${client.id}`)
            .then(response => {
                // console.log(response.data);
                if(response.status === 200){
                    EventBus.$emit('flash-message', 'The client was deleted.', 'SUCCESS');
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
    updateClient({commit}, data){
        let id = data.get('client_id');

        axios.post(`/auth/clients/${id}`, data, config)
            .then(response => {
                // self = this
                commit('SET_CLEAR_ERRORS')
                if(response !== undefined && response.status === 201)
                {
                    EventBus.$emit('flash-message', 'The client was updated.', 'SUCCESS');
                    //console.log(response.data);
                   commit('UPDATE_CLIENT', response.data);
                   commit('UPDATE_CLIENTS', response.data);
                }
                // redirect after updated
                router.push({name: 'Clients'});
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

    },
    findClient({commit}, id){
        commit('findClient', id)
    },
    updateAvatar({commit}, avatar){
        commit('updateAvatar', avatar)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
