<template>
    <div class="seo-opengraph row">
        <div class="seo-opengraph__tags col-md-6">
            <div class="form-group">
                <label>Facebook title</label>
                <input autocomplete="off" type="text" class="form-control" name="seo[opengraph][title]" :value="title"
                       @input="setTitle($event.target.value)">
            </div>
            <div class="form-group">
                <label>Facebook description</label>
                <textarea class="form-control" name="seo[opengraph][description]" rows="3" :value="description"
                          @input="setDescription($event.target.value)"></textarea>
            </div>
            <div class="form-group">
                <label>Facebook image</label>
                <input autocomplete="off" type="text" class="form-control" name="seo[opengraph][image]" :value="image"
                       @input="setTitle($event.target.value)">
                <div class="help-block small">Recommended facebook image size: 1200x630px</div>
            </div>
        </div>
        <div class="seo-opengraph__preview col-md-6 border-left">
        </div>
    </div>
</template>
<script>
    import {mapGetters, mapMutations} from 'vuex'

    export default {
        data() {
            return {
            }
        },

        computed: {
            ...mapGetters(['opengraphTitle', 'opengraphDescription'])
        },
        methods: {
            ...mapMutations(['setOpengraphTitle', 'setOpengraphDescription', 'setImage'])
        }
    }
</script>
