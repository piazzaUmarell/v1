<template>
    <div class="bg-light-gray w-screen h-min-screen">
        <section class="container mx-auto pt-20 px-4 md:px-0">
            <div class="flex flex-row justify-between">
                <h2 class="text-4xl text-center sticky">{{ this.episode ? this.episode.title : '' }}</h2>
                <span class="text-3xl">#{{ this.episode ? this.episode.number : '' }}</span>
            </div>
            <section class="flex flex-col-reverse md:flex-row">
                <article class="w-full md:w-3/5 mt-4">
                    <h3 class="md:invisible">Sommario</h3>
                    <p v-html="this.episode ? this.episode.summary : ''"></p>
                </article>
                <section class="w-full md:w-2/5 mt-4 mt-4">
                    <audio ref="player" :src="this.episodeUrl" controls class="mejs__player w-full">
                    </audio>
                </section>
            </section>
        </section>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                episode : {
                    url : null
                }
            };
        },

        created() {
            axios.get(this.$ENV.routes.episodes.latest).then(response => {
                this.episode = response.data;
            });
        },

        methods:{
            hasEpisode() {
                return typeof(this.episode) !== 'undefined';
            }
        },

        computed: {
            episodeUrl() {
                return this.episode ? this.episode.url : '/';
            }
        }


    }
</script>