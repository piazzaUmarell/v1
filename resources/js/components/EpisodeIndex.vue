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
                            <router-link :to="episode.getDetailRoute()">
                                <h2 class="title" v-text="episode.title"></h2>
                            </router-link>
                            <div class="content duration mb-6 font-bold lg:font-normal">
                                <font-awesome-icon icon="clock"></font-awesome-icon>
                                <span v-text="episode.duration"></span>
                            </div>
                        </section>
                        <span class="content" v-text="episode.abstract"></span>
                        <section class="footer">
                            <ul class="tag-list lg:flex">
                                <li class="tag episode mb-2 lg:mb-0">
                                    <span class="title text-blue-darkest" v-text="'Episodio #' + episode.number"></span>
                                </li>
                                <li class="tag mb-2 lg:mb-0" v-for="tag in episode.tags">
                                    <span class="title text-blue-darkest" v-text="tag.name"></span>
                                </li>
                            </ul>
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

    export default {
        name: "EpisodeIndex",
        mixins: [EpisodeAccessor],

        components: {
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
            font-size: 6rem;
        }

        ul > li {
            @apply pt-16 pb-8 border-t border-dashed border-blue-darkest flex flex-row justify-start items-start;

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
                    @apply flex justify-start items-baseline;

                    .title {
                        @apply my-0 text-left text-5xl mb-4;
                    }

                    > * {
                        @apply text-black;

                        &:first-child {
                            @apply ml-0;
                        }
                    }
                }

                .footer {
                    @apply mt-8 flex-row;

                    .title {
                        @apply text-3xl;
                    }

                    .tag-list{
                        @apply flex-row flex-1 list-reset;

                        li {
                            @apply bg-grey-lighter rounded-full px-4 border-none py-0 mr-4 flex flex-col justify-center items-center;

                            &.episode {
                                span {
                                    @apply text-white;
                                }
                                background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));
                            }

                            span{
                                @apply my-0;
                            }
                        }

                    }
                }

                .content {
                    &.duration {
                        @apply whitespace-no-wrap;
                    }
                    @apply text-black text-3xl;
                }
            }
        }
    }
</style>