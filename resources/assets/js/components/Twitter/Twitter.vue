<template>
    <div class="seo-twitter row">
        <div class="seo-twitter__tags col-md-6">
            <div class="form-group">
                <label>Twitter title</label>
                <input autocomplete="off" type="text" class="form-control" name="seo[twitter][title]" :value="title"
                       @input="setTitle($event.target.value)">
            </div>
            <div class="form-group">
                <label>Twitter description</label>
                <textarea class="form-control" name="seo[twitter][description]" rows="3" :value="description"
                          @input="setDescription($event.target.value)"></textarea>
            </div>
            <div class="form-group">
                <label>Twitter image</label>
                <input autocomplete="off" type="text" class="form-control" name="seo[twitter][image]" :value="image"
                       @input="setTitle($event.target.value)">
                <div class="help-block small">Recommended twitter image size: 1024x512px</div>
            </div>
        </div>
        <div class="seo-twitter__preview col-md-6 border-left">
        </div>
    </div>
</template>
<script>
    export default {}
</script>
