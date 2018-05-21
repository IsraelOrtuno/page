<template>
    <div class="seo-metas">
        <div class="row">
            <div class="seo-meta__tags col-md-6">
                <!-- Slug -->
                <div class="form-group">
                    <label>Slug</label>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ url }}</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" name="page[slug]" v-model="slug">
                    </div>
                </div>

                <!-- Page title -->
                <div class="form-group">
                    <label class="d-flex">Page title
                        <span class="d-inline-block ml-auto font-weight-normal small">{{ title.length}}/60</span>
                    </label>
                    <input autocomplete="off" type="text" class="form-control form-control-sm" name="page[meta][title]"
                           v-model="title">
                    <div class="text-danger font-weight-bold small mt-2" v-if="title.length > 60">
                        The title should not be longer than 60 characters.
                    </div>

                </div>

                <!-- Meta description -->
                <div class="form-group">
                    <label class="d-flex">Meta description
                        <span class="d-inline-block ml-auto font-weight-normal small">{{ description.length}}/300</span>
                    </label>
                    <textarea class="form-control form-control-sm" name="page[meta][description]" rows="3" v-model="description"></textarea>
                    <div class="text-danger font-weight-bold small mt-2" v-if="description.length > 300">
                        The description should not be longer than 300 characters.
                    </div>
                </div>
            </div>
            <div class="seo-meta__preview col-md-6 border-left">
                <preview></preview>
            </div>
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
            url() {
                return window.location.protocol + '//' + window.location.host + '/'
            },
            slug: {
                get() {
                    return this.sharedState.slug
                },
                set(value) {
                    this.sharedState.slug = value
                }
            },
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