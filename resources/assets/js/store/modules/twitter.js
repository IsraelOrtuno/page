import {commonGetters, commonMutations} from '../social'

// initial state
const state = window.__seo.store.twitter || {}

// getters
const getters = {
    ...commonGetters
}

// mutations
const mutations = {
    ...commonMutations
}

export default {state, getters, mutations}