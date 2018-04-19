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
            <div class="card-footer bg-dadrk textd-white">
                <variables></variables>
            </div>
        </div>
    </div>
</template>

<script>
    import Tabs from './Tabs'
    import Metas from './Meta/Metas'
    import store from '../store/index'
//    import Twitter from './Twitter/Twitter'
    import Advanced from './Advanced/Advanced'
//    import Opengraph from './Opengraph/Opengraph'
    import Variables from './Variables/Variables'

    export default {
        components: {Tabs, Metas, Advanced, Variables},
    }
</script>