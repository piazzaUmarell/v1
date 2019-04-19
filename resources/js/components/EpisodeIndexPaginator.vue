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
    }
</script>

<style scoped lang="scss">
    .paginator {
        ul {
            @apply list-reset flex flex-row w-full rounded border border-grey-dark text-5xl;
        }
    }
</style>