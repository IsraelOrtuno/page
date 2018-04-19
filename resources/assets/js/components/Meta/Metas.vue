<template>
    <div class="seo-metas row">
        <div class="seo-meta__tags col-md-6">
            <div class="form-group">
                <label>SEO title</label>
                <input autocomplete="off" type="text" class="form-control" name="seo[meta][title]" :value="title"
                       @input="setTitle($event.target.value)">
                <div class="small text-right">
                    <span class="text-danger font-weight-bold"
                          v-if="title.length > 60">Your title should not be longer than 60 characters!</span>
                    <span v-text="title.length"></span> / <span>60</span>
                </div>
            </div>
            <div class="form-group">
                <label>Meta description</label>
                <textarea class="form-control" name="seo[meta][description]" rows="3" :value="description"
                          @input="setDescription($event.target.value)"></textarea>
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
    import {mapGetters, mapMutations} from 'vuex'

    export default {
        components: {Preview},

        computed: {
            ...mapGetters(['title', 'description'])
        },

        methods: {
            ...mapMutations(['setTitle', 'setDescription'])
        },
    }
</script>