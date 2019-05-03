<template>
    <section class="episode-detail" v-if="episode">
        <nav>
            <ul>
                <li>
                    <router-link :to="homepageLink">
                        <font-awesome-icon class="mr-4" icon="home"></font-awesome-icon>
                        Home
                    </router-link>
                </li>
                <li>
                    <font-awesome-icon class="mr-4" icon="podcast"></font-awesome-icon>
                    <span v-text="episode.getTitle()"></span>
                </li>
            </ul>
        </nav>

        <article>
            <header class="episode-information">
                <span v-text="'Episodio: ' + episode.getNumber()"></span>
                <span v-text="'Durata: ' + episode.getDuration()"></span>
                <span v-text="'Data di uscita: ' + episode.getPublicationDateForHumans()"></span>
            </header>
            <h1 class="title" v-text="episode.getTitle()"></h1>
            <h2 class="subtitle" v-text="episode.getAbstract()"></h2>
            <div class="content-wrapper flex flex-col-reverse lg:flex-row mt-16">
                <div class="description w-full lg:w-1/3">
                    <p v-html="episode.getDescription()"></p>
                </div>
                <div class="player-container flex-1 rounded lg:ml-4 mb-4 lg:mb-0">
                    <episode-player :episode="episode"></episode-player>
                    <div class="flex flex-row mt-4 items-baseline"
                         style="margin-left: 5px; margin-right: 5px;"
                    >
                        <div class="mr-4 text-white uppercase font-bold">Argomenti: </div>
                        <episode-tag-index
                                :episode="episode"
                                :display-episode-number="false"
                        ></episode-tag-index>
                    </div>

                </div>
            </div>
        </article>
    </section>
</template>

<script>

    import Constants from "../Constants";
    import EpisodePlayer from "./EpisodePlayer";
    import EpisodeAccessor from "../mixins/EpisodeAccessor";
    import { faHome, faPodcast } from '@fortawesome/free-solid-svg-icons';
    import { library } from '@fortawesome/fontawesome-svg-core';
    import EpisodeTagIndex from "./EpisodeTagIndex";

    export default {
        name: "Episode",
        mixins: [EpisodeAccessor],
        components: {EpisodeTagIndex, EpisodePlayer},

        created() {
            library.add(faHome, faPodcast);
        },

        mounted() {
            this.init(this.$route.params.slug);
        },

        computed: {
            homepageLink() {
                return { name: Constants.ROUTE_HOMEPAGE };
            }
        }
    }
</script>

<style lang="scss" scoped>

    .episode-detail {
        @apply w-full z-10 flex flex-col justify-start pb-12;
        min-height: 100%;
        background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));

        nav {
            @apply w-full border-b border-white;
            background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo"));

            ul {
                @apply list-reset flex flex-row justify-start p-4;

                li {

                    @apply text-xl text-white flex flex-row justify-start items-center;

                    &::after {
                        @apply block mx-4;
                        content:">"
                    }

                    &:last-child::after {
                        content: "";
                    }

                    a {
                        @apply text-xl text-white no-underline;
                    }
                }
            }
        }

        article {
            @apply px-32 mt-8;

            .episode-information {
                @apply uppercase text-grey-light font-bold text-xl leading-loose flex flex-row justify-start;

                > * {
                    @apply mr-6;
                }
            }

            h1 {
                font-size: 5rem;
                letter-spacing: 0.3rem;
            }

            h2 {
                @apply text-3xl text-white;
            }

            .content-wrapper {
                .description {
                    @apply border border-white p-4 rounded text-white;
                    background-color: rgba(0,0,0, 0.0625);
                    max-height: 300px;
                    overflow: auto;

                    a, a:active, a:hover {
                        @apply text-white font-bold;
                    }

                }
            }

        }
    }

</style>