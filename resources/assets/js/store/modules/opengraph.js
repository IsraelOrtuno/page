import {commonGetters, commonMutations} from '../social'

// initial state
const state = window.__seo.store.opengraph || {}

// getters
const getters = {
    opengraphTitle: () => state.title,
    opengraphDescription: () => state.description,
    opengraphCompiledContent: () => {
        return {
            title: compiler.compile(state.title),
            description: compiler.compile(state.description)
        }
    }}

// mutations
const mutations = {
    setOpengraphTitle(state, value) {
        state.title = value
    },

    setOpengraphDescription(state, value) {
        state.description = value
    },

    setOpengraphImage(state, value) {
        state.image = value
    }
}

export default {state, getters, mutations}