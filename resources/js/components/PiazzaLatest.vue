<template>
    <div class="bg-light-gray w-screen h-min-screen">
        <section class="container mx-auto pt-20 px-4 md:px-0">
            <div class="flex flex-row justify-between">
                <h2 class="text-4xl text-center sticky"></h2>
                <span class="text-3xl"></span>
            </div>
            <section class="flex flex-col-reverse md:flex-row">
                <article class="w-full md:w-3/5 mt-4"></article>
                <section class="w-full md:w-2/5 mt-4 mt-4">
                    <audio ref="player" controls class="mejs__player w-full">
                        <source type="audio/mp3" src="https://piazzaumarell.it/puntate/PiazzaUmarell_90.mp3">
                    </audio>
                </section>
            </section>
        </section>
    </div>
</template>

<script>
    export default {
    }
</script>