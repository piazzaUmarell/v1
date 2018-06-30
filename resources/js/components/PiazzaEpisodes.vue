<template>
    <ul
        class="list-reset flex flex-col justify-start flex-wrap w-full mx-auto pb-10 mt-10"
        v-infinite-scroll="nextPage"
        infinite-scroll-disabled="busy"
        infinite-scroll-distance="300"
    >
        <piazza-episode
            v-for="episode in this.episodes"
            :key="episode.date"
            :episode="episode"
        />
        <li v-show="this.shouldSpin" class="text-center my-8">
            <font-awesome-icon
                icon="spinner"
                class="text-5xl text-black spinner"
            />
            <p class="text-black leading-loose text-4xl">Loading...</p>
        </li>
    </ul>
</template>

<script>
    import axios from 'axios';
    import PiazzaEpisode from './PiazzaEpisode';
    import { library } from '@fortawesome/fontawesome-svg-core';
    import { faSpinner } from '@fortawesome/free-solid-svg-icons';

    export default {

        components: {
            PiazzaEpisode
        },

        data(){
            return {
                episodes : [],
                latestPage: 1,
                busy : false,
                finished: false
            };
        },

        created() {
            library.add(faSpinner);
            this.nextPage();
        },

        methods: {
            nextPage() {
                this.busy = true;
                axios.get(
                    this.$ENV.routes.episodes.page + this.latestPage
                ).then( response => {
                    if(response.data.page == this.latestPage) {
                        this.episodes = this.episodes.concat(response.data.content);
                        this.latestPage++;
                    }
                    this.busy = !response.data.hasNextPage;
                    this.finished = response.data.hasNextPage;
                });
            }
        },

        computed: {
            shouldSpin() {
                return !this.busy || this.finished;
            }
        }
        
    }
</script>

<style lang="scss">
    @keyframes spin { 
        100% { 
            -webkit-transform: rotate(360deg);
            transform:rotate(360deg); 
        } 
    }

    .spinner {
        transform-origin: center center;
        animation:spin 4s linear infinite;
    }


</style>