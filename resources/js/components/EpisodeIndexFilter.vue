<template>
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
</template>

<script>

    import EpisodeAccessor from "../mixins/EpisodesAccessor";

    import { faSearch } from '@fortawesome/free-solid-svg-icons'
    import { library } from '@fortawesome/fontawesome-svg-core';
    import KeywordCollection from "../api/KeywordCollection";

    export default {
        name: "EpisodeIndexFilter",
        mixins: [EpisodeAccessor],

        data() {
            return {
                keywords: ""
            }
        },

        created() {
            library.add(faSearch);
        },

        methods: {
            triggerFilter() {
                this.applyKeywords(
                    this.keywords
                );
            }
        }
    }
</script>

<style lang="scss" scoped>
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
</style>