const commonGetters = {
    title: () => state.title,
    description: () => state.description,
    compiledContent: () => {
        return {
            title: compiler.compile(state.title),
            description: compiler.compile(state.description)
        }
    }
}

const commonMutations = {
    setTitle(state, value) {
        state.title = value
    },

    setDescription(state, value) {
        state.description = value
    },

    setImage(state, value) {
        state.image = value
    }
}

export default {commonGetters, commonMutations}