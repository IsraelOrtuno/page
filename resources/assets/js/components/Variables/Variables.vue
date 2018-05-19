<template>
    <div class="seo-variables d-flex justify-content-between">
        <variable v-for="(value, key) in variables" :key="key" :name="key" :value="value"></variable>
    </div>
</template>

<script>
    import Variable from './Variable'

    export default {
        props: ['variables'],
        components: { Variable }
    }
</script>
