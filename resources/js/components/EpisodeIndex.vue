<template>
    <section class="episode-index w-full">
        <h1 class="title">Episodi</h1>
        <header class="filter">
            <div class="input-container">
                <label class="ml-4" for="filter">
                    <font-awesome-icon icon="search" class="text-grey-darker"></font-awesome-icon>
                </label>
                <input
                        id="filter"
                        type="text"
                        @keyup="triggerFilter"
                        v-model="keywords"
                        placeholder="Filtra per titolo..."
                >
            </div>
        </header>
        <main class="w-full md:w-5/6 mx-auto">
            <ul class="list-reset">
                <li v-for="episode in episodes">
                    <router-link class="play" :to="episode.getDetailRoute()">
                        <font-awesome-icon icon="play"></font-awesome-icon>
                    </router-link>
                    <div class="container">
                        <section class="title-container">
                            <router-link :to="episode.getDetailRoute()">
                                <h2 class="title" v-text="episode.title"></h2>
                            </router-link>
                            <span class="content duration" v-text="'[ ' + episode.duration + ' ]'"></span>
                        </section>
                        <span class="content" v-text="episode.abstract"></span>
                        <br>
                        <section class="footer">
                            <ul class="tag-list">
                                <li class="tag episode">
                                    <span class="title text-blue-darkest" v-text="'Episodio #' + episode.number"></span>
                                </li>
                                <li class="tag" v-for="tag in episode.tags">
                                    <span class="title text-blue-darkest" v-text="tag.name"></span>
                                </li>
                            </ul>
                            <span class="content italic float-right" v-text="episode.getPublicationDateForHumans()"></span>
                        </section>
                    </div>
                </li>
            </ul>
        </main>
        <episode-index-paginator></episode-index-paginator>
    </section>
</template>

<script>

    import EpisodeAccessor from "../mixins/EpisodesAccessor";
    import EpisodeIndexPaginator from "./EpisodeIndexPaginator";

    import { faPlay, faSearch } from '@fortawesome/free-solid-svg-icons'
    import { library } from '@fortawesome/fontawesome-svg-core';

    export default {
        name: "EpisodeIndex",
        mixins: [EpisodeAccessor],
        components: {
            EpisodeIndexPaginator
        },

        data() {
            return {
                keywords: ""
            }
        },

        created() {
            library.add(faPlay, faSearch);
        },

        methods: {
            triggerFilter() {
                this.applyKeywords(this.keywords);
            }
        }


    }
</script>

<style scoped lang="scss">
    .episode-index {

        .filter {
            @apply text-3xl mb-8 sticky pin-t bg-white py-4 w-full px-32;

            .input-container {
                @apply rounded-full border border-grey-lighter bg-grey-lighter px-8 outline-none pt-4 pb-2 flex items-baseline;

                input {
                    @apply outline-none pl-4 flex-1;
                    background: transparent;
                }
            }
        }

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

                .footer {
                    @apply mt-8 flex flex-row;

                    .title {
                        @apply text-3xl;
                    }

                    .tag-list{
                        @apply flex flex-row flex-1 list-reset;

                        li {

                            &.episode {
                                span {
                                    @apply text-white;
                                }
                                background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));
                            }

                            @apply bg-grey-lighter rounded-full px-4 border-none py-0 mr-4;

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