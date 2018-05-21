<template>
    <div class="seo-app">
        <tabs></tabs>

        <div class="card border-top-0">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="meta" role="tabpanel" aria-labelledby="meta-tab">
                        <metas></metas>
                    </div>
                    <div class="tab-pane fade show" id="opengraph" role="tabpanel" aria-labelledby="opengraph-tab">
                        <!--<opengraph></opengraph>-->
                    </div>
                    <div class="tab-pane fade show" id="twitter" role="tabpanel" aria-labelledby="twitter-tab">
                        <!--<twitter></twitter>-->
                    </div>
                    <div class="tab-pane fade show" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">
                        <advanced></advanced>
                    </div>
                </div>
            </div>
            <!--<div class="card-footer bg-dadrk textd-white">-->
                <!--<variables :variables="data"></variables>-->
            <!--</div>-->
        </div>
    </div>
</template>

<script>
    import store from './store'
    import Tabs from './components/Tabs'
    import Metas from './components/Meta/Metas'
    // import store from './store/index'
    //    import Twitter from './Twitter/Twitter'
    import Advanced from './components/Advanced/Advanced'
    //    import Opengraph from './Opengraph/Opengraph'
    import Variables from './components/Variables/Variables'
    import Compiler from "./compiler";

    window.compiler = new Compiler({})

    export default {
        props: ['data', 'store'],
        components: {Tabs, Metas, Advanced, Variables},

        data() {
            return {
                privateState: {},
                sharedState: store.state
            }
        },

        beforeMount() {
            this.$set(this.sharedState, 'slug', this.store.slug)
            this.$set(this.sharedState, 'meta', this.store.meta)
            // this.sharedState.meta = this.store.meta
            // store.state = this.store
            compiler.setSources(this.data)
        }
    }
</script>