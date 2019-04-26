<template>
    <section class="paginator">
        <ul>
            <li class="first" v-if="!isFirstPage">
                <button @click="first">
                    <router-link :to="{ route: homepageRouteName , query: {'page': 1 } }">
                        <font-awesome-icon icon="fast-backward"></font-awesome-icon>
                    </router-link>
                </button>
            </li>
            <li class="prev" v-if="!isFirstPage">
                <button @click="previous">
                    <router-link :to="{ route: homepageRouteName , query: {'page': currentPage - 1 } }">
                        <font-awesome-icon icon="step-backward"></font-awesome-icon>
                    </router-link>
                </button>
            </li>
            <li class="page-accessor"></li>
            <li
                v-for="pageIndex in this.pagesInterval"
                :class="{'active' : pageIndex === currentPage}">
                <button @click="page(pageIndex)">
                    <router-link :to="{ route: homepageRouteName , query: {'page': pageIndex } }">
                        <span v-text="pageIndex"></span>
                    </router-link>
                </button>
            </li>
            <li class="page-accessor"></li>
            <li class="next" v-if="!isLastPage">
                <button @click="next">
                    <router-link :to="{ route: homepageRouteName , query: {'page': currentPage + 1 } }">
                        <font-awesome-icon icon="step-forward"></font-awesome-icon>
                    </router-link>
                </button>
            </li>
            <li class="last" v-if="!isLastPage">
                <button @click="last">
                    <router-link :to="{ route: homepageRouteName , query: {'page': lastPage } }">
                        <font-awesome-icon icon="fast-forward"></font-awesome-icon>
                    </router-link>
                </button>
            </li>
        </ul>
    </section>
</template>

<script>
    import Constants from "../Constants";
    import EpisodeAccessor from "../mixins/EpisodesAccessor";
    import { faFastBackward, faStepBackward, faStepForward, faFastForward  } from '@fortawesome/free-solid-svg-icons'
    import { library } from '@fortawesome/fontawesome-svg-core';

    export default {
        name: "EpisodeIndexPaginator",
        mixins: [EpisodeAccessor],

        created() {
            library.add(faStepBackward, faFastBackward, faFastForward, faStepForward);
        },

        computed: {
            pagesInterval() {
                let minPage = Math.max(1, this.currentPage - 2);
                let maxPage = Math.min(this.lastPage, this.currentPage + 2);
                let range = [];
                for(let i = minPage; i <= maxPage; i++) {
                    range.push(i);
                }
                return range;
            },

            homepageRouteName() {
                return Constants.ROUTE_HOMEPAGE;
            }
        }
    }
</script>

<style scoped lang="scss">
    .paginator {
        @apply my-8;

        ul {
            @apply list-reset flex flex-row w-full rounded text-5xl justify-center;

            li {
                @apply w-16 h-16 flex justify-center items-center p-2;
                box-sizing: content-box;

                button {
                    @apply outline-none;

                    a {
                        @apply text-blue-darkest;
                    }
                }

                &.active {
                    @apply rounded-full text-white;
                    background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));

                    a {
                        @apply text-white;
                    }
                }

                &.page-accessor{
                    @apply mx-4 w-auto;
                }
            }
        }
    }
</style>