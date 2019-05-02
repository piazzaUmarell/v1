<template>
    <section class="episode-detail" v-if="episode">
        <h1 class="title" v-text="episode.getTitle()"></h1>
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

<style lang="scss" scoped>

    .episode-detail {
        @apply w-full z-10 flex flex-col justify-between pb-12;
        min-height: 100%;
        background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));
    }

</style>