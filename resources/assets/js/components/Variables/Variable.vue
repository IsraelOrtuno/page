<template>
    <div class="seo-variable text-whidte">
        <div class="seo-variable__item d-inline">
            <small class="seo-variable__name">${{name}}</small>
            <small>(<span class="seo-variable__type" v-text="typeof value"></span>)</small>
        </div>
        :
        <div class="seo-variable__value d-inline">
            <span v-if="typeof value !== 'object'" v-text="value"></span>
            <variable v-else v-for="(val, name) in value" :key="name" :name="name"
                      :value="val"></variable>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'variable',
        props: ['name', 'value'],
    }
</script>

<style lang="scss">
    .seo-variable {
        padding-left : 1rem;
        margin-top   : .5rem;

        &__name {
            border-radius : 5px;
            padding       : 0 4px;
            background    : #dee2e6;
            display       : inline-block;
        }
    }
</style>