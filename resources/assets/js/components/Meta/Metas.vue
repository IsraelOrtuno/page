<template>
    <div class="seo-metas row">
        <div class="seo-meta__tags col-md-6">
            <div class="form-group">
                <label>SEO title</label>
                <input autocomplete="off" type="text" class="form-control" name="seo[meta][title]"
                       v-model="title">
                <div class="small text-right">
                    <span class="text-danger font-weight-bold" v-if="title.length > 60">Your title should not be longer than 60 characters!</span>
                    <span v-text="title.length"></span> / <span>60</span>
                </div>
            </div>
            <div class="form-group">
                <label>Meta description</label>
                <textarea class="form-control" name="seo[meta][description]" rows="3" v-model="description"></textarea>
                <div class="small text-right">
                    <span class="text-danger font-weight-bold" v-if="description.length > 300">Your description should not be longer than 300 characters!</span>
                    <span v-text="description.length"></span> / <span>300</span>
                </div>
            </div>
        </div>
        <div class="seo-meta__preview col-md-6 border-left">
            <preview></preview>
        </div>
    </div>
</template>

<script>
    import Preview from './Preview'
    import store from '../../store'

    export default {
        components: {Preview},

        data() {
            return {
                privateState: {},
                sharedState: store.state
            }
        },

        computed: {
            title: {
                get() {
                    return this.sharedState.meta.title
                },
                set(value) {
                    this.sharedState.meta.title = value
                }
            },
            description: {
                get() {
                    return this.sharedState.meta.description
                },
                set(value) {
                    this.sharedState.meta.description = value
                }
            }
        },
    }
</script>