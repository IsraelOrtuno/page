import Vue from 'vue'
import Vuex from 'vuex'
import meta from './modules/meta'
import Compiler from '../compiler'
// import createLogger from '../../../src/plugins/logger'

Vue.use(Vuex)

// TODO: Can't be a const?
window.compiler =  new Compiler(__seo.data)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        meta,
    },
    strict: debug,
    // plugins: debug ? [createLogger()] : []
})