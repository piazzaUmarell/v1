<template>
    <ul class="tag-list lg:flex">
        <li class="tag episode mb-2 lg:mb-0" v-if="episodeNumberVisible">
            <span
                class="title text-blue-darkest"
                v-text="'Episodio #' + episode.number"
            ></span>
        </li>
        <li class="tag mb-2 lg:mb-0" v-for="tag in episode.tags">
            <span class="title text-blue-darkest" v-text="tag.name"></span>
        </li>
    </ul>
</template>

<script>
    import Episode from "../model/Episode";

    export default {
        name: "EpisodeTagIndex",
        props:{
            episode: {
                type: Episode,
                required: true
            },
            displayEpisodeNumber: {
                type: Boolean,
                default: true
            }
        },

        computed: {
            episodeNumberVisible() {
                return this.$props.displayEpisodeNumber;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .tag-list{
        @apply flex-row flex-1 list-reset;

        li {
            @apply text-lg bg-grey-lighter rounded-full px-4 border-none py-1 mr-4 flex flex-col justify-center items-center;

            .title {
                @apply text-lg;
            }

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
</style>