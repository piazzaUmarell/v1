<template>
    <li class="w-full">
        <article class="mx-2 shadow bg-blue flex flex-col items-stretch h-full border-b-2 mb-4">
            <header @click="toggle" :class="{ 'bg-blue text-white open' : active, 'bg-white text-black' : !active }" class="flex flex-row no-wrap justify-between p-4 py-3 leading-none cursor-pointer-disabled">
                <div class="flex flex-row justify-between md:justify-start align-bottom flex-1">
                    <div class="hidden flex-col justify-center mr-4 hide">
                        <font-awesome-icon
                            v-show="false"
                            icon="chevron-down"
                            class="animated"
                        />
                    </div>
                    <h3 class="text-2xl" v-text="this.episode.title"></h3>
                    <h3 class="ml-2">
                        #<span
                            class="leading-normal"
                            v-text="this.episode.number"
                        ></span>
                    </h3>
                </div>
                <div class="hidden md:flex flex-row align-baseline justify-end">
                    <div
                        v-text="this.episode.date"
                        class="mr-2 leading-normal invisible md:visible"
                    ></div>
                </div>
            </header>
            <section class="body">
                <section class="bg-white p-4 leading-normal flex-1" v-text="this.episode.abstract"></section>
                <footer class="bg-white px-6 py-4 flex flex-row justify-between">
                    <div
                        v-text="this.episode.date"
                        class="mr-2 leading-normal visible md:invisible"
                    ></div>

                    <a href="#" class="text-blue no-underline font-black">Dettaglio &raquo;</a>
                </footer>
            </section>
        </article>
    </li>
</template>

<script>
    import { library } from '@fortawesome/fontawesome-svg-core';
    import { faChevronDown } from '@fortawesome/free-solid-svg-icons';
    import { faChevronUp } from '@fortawesome/free-solid-svg-icons';

    export default {
        props: [
            'episode'
        ], 

        data(){
            return {
                active : true
            };
        },

        created() {
            library.add(faChevronDown);
            library.add(faChevronUp);
        },
        
        methods: {
            toggle() {
                this.active = this.active;
            }
        }
    }
</script>



<style lang="scss">
    .body{
        height:0;
        overflow:hidden;
    }

    .open {
        + .body {
            height:100%;
        }
    }
</style>