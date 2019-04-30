<template>
    <section v-if="episode">
        <h1 v-text="episode.getTitle()"></h1>
        <h2 v-text="episode.getAbstract()"></h2>
        <p v-html="episode.getDescription()"></p>
    </section>
</template>

<script>

    import EpisodeAccessor from "../mixins/EpisodeAccessor";

    export default {
        name: "Episode",
        mixins: [EpisodeAccessor],

        mounted() {
            this.init(this.$route.params.slug);
        }
    }
</script>

<style scoped>

</style>