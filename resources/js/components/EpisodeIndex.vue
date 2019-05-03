<template>
    <section class="episode-index w-full">
        <h1 class="title">Episodi</h1>
        <episode-index-filter></episode-index-filter>

        <section class="w-full md:w-5/6 mx-auto">
            <ul class="list-reset">
                <li v-for="episode in episodes">
                    <router-link class="play" :to="episode.getDetailRoute()">
                        <font-awesome-icon icon="play"></font-awesome-icon>
                    </router-link>
                    <div class="container">
                        <section class="title-container flex-col">
                            <router-link class="no-underline" :to="episode.getDetailRoute()">
                                <h2 class="title" v-text="episode.title"></h2>
                            </router-link>
                            <div class="content duration mb-4 font-bold font-normal">
                                <font-awesome-icon icon="clock"></font-awesome-icon>
                                <span v-text="episode.duration"></span>
                            </div>
                        </section>
                        <span class="content" v-text="episode.abstract"></span>
                        <section class="footer">
                            <episode-tag-index
                                :episode="episode"
                            ></episode-tag-index>
                            <span class="content italic block w-full text-center lg:text-right mt-4 lg:mt-4" v-text="episode.getPublicationDateForHumans()"></span>
                        </section>
                    </div>
                </li>
            </ul>
        </section>
        <episode-index-paginator></episode-index-paginator>
    </section>
</template>

<script>

    import EpisodeIndexFilter from "./EpisodeIndexFilter";
    import EpisodeAccessor from "../mixins/EpisodesAccessor";
    import EpisodeIndexPaginator from "./EpisodeIndexPaginator";

    import { faPlay, faClock } from '@fortawesome/free-solid-svg-icons'
    import { library } from '@fortawesome/fontawesome-svg-core';
    import EpisodeTagIndex from "./EpisodeTagIndex";

    export default {
        name: "EpisodeIndex",
        mixins: [EpisodeAccessor],

        components: {
            EpisodeTagIndex,
            EpisodeIndexFilter,
            EpisodeIndexPaginator
        },

        created() {
            library.add(faPlay, faClock);
        },
    }
</script>

<style scoped lang="scss">
    .episode-index {

        main {
            @apply px-16 pb-32 mx-auto mt-8;
        }

        .title {
            @apply text-blue-darkest mt-16 mb-32 text-center;
            font-size: 5rem;
        }

        ul > li {
            @apply pt-8 pb-4 border-t border-dashed border-blue-darkest flex flex-row justify-start items-start;

            &:first-child {
                @apply pt-0 border-t-0;
            };

            .play {
                @apply mt-1 p-8 rounded-full bg-blue-dark flex justify-center items-center text-2xl border border-white text-white mr-4;
                width:0; height:0;
                background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));

                > * {
                    @apply ml-1;
                }

            }


            .container {
                .title-container {
                    @apply flex justify-start items-baseline;

                    .title {
                        @apply mt-0 text-left text-2xl mb-2;
                    }

                    > * {
                        @apply text-black;

                        &:first-child {
                            @apply ml-0;
                        }
                    }
                }

                .footer {
                    @apply mt-6 flex-row;

                    .title {
                        @apply text-lg;
                    }
                }

                .content {
                    &.duration {
                        @apply whitespace-no-wrap;
                    }
                    @apply text-black text-lg;
                }
            }
        }
    }
</style>