<template>
    <section class="episode-index w-4/5 md:2/3 lg:1/2">
        <h1 class="title">Episodi</h1>
        <ul class="list-reset">
            <li v-for="episode in episodes">
                <router-link class="play" :to="episode.getDetailRoute()">
                    <font-awesome-icon icon="play"></font-awesome-icon>
                </router-link>
                <div class="container">
                    <section class="title-container">
                        <router-link :to="episode.getDetailRoute()">
                            <h2 class="title" v-text="episode.title + ', Episodio #' + episode.number + '' "></h2>
                        </router-link>
                        <span class="content duration" v-text="'[ ' + episode.duration + ' ]'"></span>
                    </section>
                    <span class="content" v-text="episode.abstract"></span>
                    <br>
                    <span class="content italic float-right" v-text="episode.getPublicationDateForHumans()"></span>
                </div>
            </li>
        </ul>
        <episode-index-paginator></episode-index-paginator>
    </section>
</template>

<script>

    import EpisodeAccessor from "../mixins/EpisodesAccessor";
    import EpisodeIndexPaginator from "./EpisodeIndexPaginator";

    import { faPlay } from '@fortawesome/free-solid-svg-icons'
    import { library } from '@fortawesome/fontawesome-svg-core';

    export default {
        name: "EpisodeIndex",
        mixins: [EpisodeAccessor],
        components: {
            EpisodeIndexPaginator
        },

        created() {
            library.add(faPlay);
        },

        computed: {

        }
    }
</script>

<style scoped lang="scss">
    .episode-index {
        @apply px-16 pb-16 mx-auto;

        .title {
            @apply text-blue-darkest mt-16 mb-24 text-center;
            font-size: 6rem;
        }

        ul > li {
            @apply py-16 border-t border-dashed border-blue-darkest flex flex-row justify-start items-start;

            &:first-child {
                @apply pt-0 border-t-0;
            };

            .play {
                @apply p-16 rounded-full bg-red flex justify-center items-center text-5xl border border-white text-white mr-4;
                width:0; height:0;
                background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));

                > * {
                    @apply ml-1 mt-1;
                }

            }


            .container {
                .title-container {
                    @apply flex flex-row justify-start items-baseline;

                    .title {
                        @apply my-0 text-left text-5xl mb-4;
                    }

                    > * {
                        @apply ml-6 text-black;

                        &:first-child {
                            @apply ml-0;
                        }
                    }
                }

                .content {
                    @apply text-black text-3xl;
                }
            }
        }
    }
</style>