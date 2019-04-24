<template>
    <section class="paginator">
        <ul>
            <li class="first" v-if="!isFirstPage">
                <button @click="first">
                    <font-awesome-icon icon="fast-backward"></font-awesome-icon>
                </button>
            </li>
            <li class="prev" v-if="!isFirstPage">
                <button @click="previous">
                    <font-awesome-icon icon="step-backward"></font-awesome-icon>
                </button>
            </li>
            <li class="page-accessor"></li>
            <li
                v-for="pageIndex in this.pagesInterval"
                :class="{'active' : pageIndex === currentPage}">
                <button @click="page(pageIndex)" v-text="pageIndex"></button>
            </li>
            <li class="page-accessor"></li>
            <li class="next" v-if="!isLastPage">
                <button @click="next">
                    <font-awesome-icon icon="step-forward"></font-awesome-icon>
                </button>
            </li>
            <li class="last" v-if="!isLastPage">
                <button @click="last">
                    <font-awesome-icon icon="fast-forward"></font-awesome-icon>
                </button>
            </li>
        </ul>
    </section>
</template>

<script>
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
                @apply w-16 h-16 flex justify-center items-center text-blue-darkest p-2;
                box-sizing: content-box;

                button {
                    @apply outline-none;
                }

                &.active {
                    @apply rounded-full text-white;
                    background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));
                }

                &.page-accessor{
                    @apply mx-4 w-auto;
                }
            }
        }
    }
</style>