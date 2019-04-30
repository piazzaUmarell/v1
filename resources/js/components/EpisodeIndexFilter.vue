<template>
    <header class="filter lg:flex px-8 lg:px-32" :class="{sticky: scrolledPast}">
        <router-link :to="homepageRoute" class="hover:no-underline no-underline">
            <h1 class="lg:mx-16 text-center md:ml-8 md:text-left">Piazza Umarell</h1>
        </router-link>
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
    import Constants from "../Constants";
    import { faSearch } from '@fortawesome/free-solid-svg-icons'
    import { library } from '@fortawesome/fontawesome-svg-core';

    export default {
        name: "EpisodeIndexFilter",
        mixins: [EpisodeAccessor],

        data() {
            return {
                keywords: "",
                scrolledPast: false,
            }
        },

        created() {
            library.add(faSearch);
        },

        mounted() {
            window.addEventListener(
                'scroll',
                this.handleScroll.bind(this)
            );
        },

        destroyed () {
            window.removeEventListener(
                'scroll',
                this.handleScroll.bind(this)
            );
        },

        methods: {
            triggerFilter() {
                this.applyKeywords(
                    this.keywords
                );
            },

            handleScroll() {
                this.scrolledPast = window.scrollY >= this.$el.offsetTop;
            },
        },

        computed: {
            homepageRoute() {
                return {name: Constants.ROUTE_HOMEPAGE}
            }
        }
    }
</script>

<style lang="scss" scoped>

    .filter {

        @apply text-3xl mb-32 bg-white py-6 w-full items-baseline;

        &.sticky {
            @apply sticky pin-t pl-8;
            background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));

            h1 {
                display: block;
            }
        }

        h1 {
            display: none;
            content:"Piazza Umarell";
            font-family: "Pridi", serif;
            @apply py-4 text-white rounded-full text-5xl;
        }

        .input-container {
            @apply rounded-full border border-grey-lighter bg-grey-lighter px-8 outline-none pt-4 pb-2 flex items-baseline flex-1;

            input {
                @apply outline-none pl-4 flex-1;
                background: transparent;
            }
        }
    }
</style>