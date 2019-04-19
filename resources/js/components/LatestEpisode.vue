<template>
    <section v-if="latestEpisode" class="latest-episode-container w-4/5 md:w-2/3 lg:w-1/2">
        <article class="latest-episode">
            <router-link class="play" :to="latestEpisode.getDetailRoute()">
                <font-awesome-icon icon="play"></font-awesome-icon>
            </router-link>
            <section class="title-container">
                <h2 class="subtitle mr-8">#<span v-text="latestEpisode.number"></span></h2>
                <h1 class="title" v-text="latestEpisode.title"></h1>
                <span class="content" v-text="latestEpisode.duration"></span>
            </section>
        </article>
        <section class="episode-description content">
            <article v-text="latestEpisode.abstract"></article>
            <span class="float-right" v-text="latestEpisode.getPublicationDateForHumans()"></span>
        </section>
    </section>
</template>

<script>
    import episodeAccessor from "../mixins/EpisodesAccessor";
    import { faPlay } from '@fortawesome/free-solid-svg-icons'
    import { library } from '@fortawesome/fontawesome-svg-core';

    export default {
        name: "LatestEpisode",
        mixins: [episodeAccessor],

        created() {
            library.add(faPlay);
        },
    }
</script>

<style scoped lang="scss">
    .latest-episode-container {
        @apply mx-auto;

        .latest-episode {
            @apply rounded mt-32 p-4 border border-grey-light shadow-md flex flex-row justify-start items-center;
            background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-dark"));

            .play {
                @apply p-8 rounded-full border-white border mr-8 flex justify-center items-center text-white;
                width:0; height:0;
                background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));

                > * {
                    @apply block ml-1;
                }
            }

            .title-container {
                @apply flex flex-row items-baseline justify-start w-full;

                .title {
                    @apply flex-1;
                }

                .content {
                    @apply text-2xl block mr-4;
                }
            }
        }

        .episode-description {
            @apply text-3xl mt-8;

            span {
                @apply text-2xl mt-4 italic;
            }

        }
    }
</style>