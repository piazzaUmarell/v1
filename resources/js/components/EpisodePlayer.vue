<template>
    <aplayer
        :music="{
            title: episode.getTitle(),
            artist: 'Francesco, Geralt',
            src: episode.getSource(),
            pic: '/static/images/logo.jpg'
        }"
    ></aplayer>
</template>

<script>

    import Aplayer from 'vue-aplayer';

    export default {
        name: "EpisodePlayer",
        components: {Aplayer},
        props: ["episode"]
    }
</script>

<style scoped>

</style>