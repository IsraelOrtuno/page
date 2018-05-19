export default { state: {} }


// import Vue from 'vue'
// import Vuex from 'vuex'
// // import meta from './modules/meta'
// import Compiler from '../compiler'
// // import createLogger from '../../../src/plugins/logger'
//
// Vue.use(Vuex)
//
// // TODO: Can't be a const?
// window.compiler = new Compiler({})
//
// const debug = process.env.NODE_ENV !== 'production'
//
// export default new Vuex.Store({
//     state: {},
//     // modules: {
//     //     meta,
//     // },
//     getters: {
//         title: () => this.state.title,
//         description: () => this.state.description,
//         robots: () => this.state.robots || [],
//         canonical: () => this.state.canonical,
//
//         compiledContent: () => {
//             return {
//                 title: compiler.compile(this.state.title),
//                 description: compiler.compile(this.state.description),
//                 canonical: compiler.compile(this.state.canonical)
//             }
//         }
//     },
//
//     mutations: {
//         setTitle(state, value) {
//             state.title = value
//         },
//         setDescription(state, value) {
//             state.description = value
//         },
//         updateRobot(state, {key, value}) {
//             Vue.set(state.robots, key, value)
//         },
//         setCanonical(state, value) {
//             state.canonical = value
//         }
//
//         // setMeta(state, value) {
//         //     state.meta = value
//         // }
//     },
//     strict: debug,
//     // plugins: debug ? [createLogger()] : []
// })