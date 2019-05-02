<template>
    <section v-if="latest" class="latest-episode-container w-4/5 md:w-2/3 lg:w-1/2">
        <article class="latest-episode">
            <episode-player :episode="latest"></episode-player>
        </article>
        <section class="episode-description content">
            <article v-html="latest.abstract"></article>
            <span class="float-right" v-text="latest.getPublicationDateForHumans()"></span>
        </section>
    </section>
</template>

<script>
    import { faPlay, faClock } from '@fortawesome/free-solid-svg-icons'
    import { library } from '@fortawesome/fontawesome-svg-core';
    import latestEpisodeAccessor from "../mixins/LatestEpisodeAccessor";
    import EpisodePlayer from "./EpisodePlayer";

    export default {
        name: "LatestEpisode",
        components: {EpisodePlayer},
        mixins: [latestEpisodeAccessor],

        created() {
            library.add(faPlay, faClock);
        },
    }
</script>

<style scoped lang="scss">
    .latest-episode-container {
        @apply mx-auto;

        .latest-episode {
            > .aplayer {
                margin: 0 -5px;
            }
            @apply rounded mt-24 shadow-md;
            background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-dark"));
        }

        .episode-description {
            @apply text-lg mt-4;

            span {
                @apply text-base mt-4 italic;
            }

        }
    }
</style>