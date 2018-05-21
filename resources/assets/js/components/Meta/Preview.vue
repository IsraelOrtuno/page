<template>
    <div class="seo-preview">
        <div class="seo-preview__title" v-html="title"></div>
        <div class="seo-preview__link" v-html="url"></div>
        <div class="seo-preview__description" v-html="description"></div>
    </div>
</template>

<script>
    import store from '../../store'

    export default {
        data() {
            return {
                privateState: {
                    url: window.location.href
                },
                sharedState: store.state
            }
        },

        computed: {
            url() {
                let prefix = window.location.protocol + '//' + window.location.host + '/'

                if (this.sharedState.slug.length) {
                    prefix = prefix.concat(this.sharedState.slug)
                }

                return prefix
            },
            title() {
                return compiler.compile(this.sharedState.meta.title)
            },
            description() {
                return compiler.compile(this.sharedState.meta.description)
            }
        }
    }
</script>

<style lang="scss">
    .seo-preview {
        font-family : Arial, sans-serif;
        &__title {
            color : #1a0dab;
        }
        &__link {
            color : #006621
        }
        &__description {
            color : #545454
        }
    }
</style>