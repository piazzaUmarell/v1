<template>
    <header class="main-header">
        <div class="content">
            <section class="main">
                <h1 class="title" v-text="title"></h1>
                <h2 class="subtitle" v-text="subtitle"></h2>
                <p class="content" v-text="disclaimer"></p>
            </section>
            <slot></slot>
        </div>
        <slot name="footer"></slot>
    </header>
</template>

<script>
    export default {
        name: "MainHeader",
        props: ['title', 'subtitle', 'disclaimer']
    }
</script>

<style lang="scss" scoped>
    .main-header{
        @apply w-full z-10 flex flex-col justify-between pb-12;
        min-height: 100%;
        background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));

        .content {
            .main {
                @apply text-center pt-8;

                h1 {
                    font-size: 5rem;
                    letter-spacing: 0.3rem;
                }

                h2 {
                    font-size: 3.5rem;
                    margin-bottom: 1rem;
                }

                p {
                    font-size: 1.75rem;
                }
            }
            .latest-episode-player {
                @apply mt-8 mx-auto;
            }
        }

        .decoration {
            @apply flex;
            .carve-shape {
                @apply h-full w-full;
                svg {
                    @apply w-full h-full;
                }
            }
        }
    }
</style>