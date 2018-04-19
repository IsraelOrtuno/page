import Vue from 'vue'

// initial state
// shape: [{ id, quantity }]
const state = window.__seo.store.meta

// getters
const getters = {
    title: () => state.title,
    description: () => state.description,
    robots: () => state.robots,
    canonical: () => state.canonical,

    compiledContent: () => {
        return {
            title: compiler.compile(state.title),
            description: compiler.compile(state.description),
            canonical: compiler.compile(state.canonical)
        }
    }
}

// mutations
const mutations = {
    setTitle(state, value) {
        state.title = value
    },

    setDescription(state, value) {
        state.description = value
    },

    updateRobot(state, {key, value}) {
        Vue.set(state.robots, key, value)
    },

    setCanonical(state, value) {
        state.canonical = value
    }
}

export default {state, getters, mutations}