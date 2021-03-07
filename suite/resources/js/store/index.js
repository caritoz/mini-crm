import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import clients from './modules/clients'
import transactions from './modules/transactions'

// import createLogger from '../../../src/plugins/logger'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        auth,
        transactions,
        clients
    },
    strict: debug,
    // plugins: debug ? [createLogger()] : []
})
