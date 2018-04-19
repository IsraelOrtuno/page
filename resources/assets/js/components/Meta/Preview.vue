<template>
    <div class="seo-preview">
        <div class="seo-preview__title" v-html="compiledContent.title"></div>
        <div class="seo-preview__link" v-text="url"></div>
        <div class="seo-preview__description" v-html="compiledContent.description"></div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data() {
            return {
                url: window.location.href
            }
        },

        computed: {
            ...mapGetters(['compiledContent'])
        },
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