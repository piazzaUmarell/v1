<template>
    <div class="bg-light-gray w-screen h-in-screen">
        <section class="container mx-auto pt-20">
            <h2 class="text-4xl text-center sticky">I nostri episodi</h2>
            <piazza-episodes />
        </section>
    </div>
</template>

<script>
    import PiazzaEpisodes from './PiazzaEpisodes';

    export default {
        components: {
            PiazzaEpisodes
        }
    }
</script>