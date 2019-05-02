<template>
    <div class="social-links">
        <a href="http://feeds.feedburner.com/PiazzaUmarell/Cwoj" target="_blank">
            <font-awesome-icon icon="rss"></font-awesome-icon>
        </a>

        <a href="mailto:sedialibera@piazzaumarell.it">
            <font-awesome-icon :icon="['far', 'envelope']"></font-awesome-icon>
        </a>

        <a href="https://itunes.apple.com/it/podcast/piazza-umarell/id1147684863?mt=2" target="_blank">
            <font-awesome-icon icon="podcast"></font-awesome-icon>
        </a>

        <a href="https://t.me/joinchat/AAAAAEHuCv9Q5UAwbnZlYA" target="_blank">
            <font-awesome-icon :icon="['fab', 'telegram-plane']"></font-awesome-icon>
        </a>
    </div>
</template>

<script>

    import { faPodcast, faRss } from '@fortawesome/free-solid-svg-icons';
    import { faTelegramPlane } from '@fortawesome/free-brands-svg-icons';
    import { faEnvelope } from '@fortawesome/free-regular-svg-icons';
    import { library } from '@fortawesome/fontawesome-svg-core';

    export default {
        name: "SocialLinks",

        created() {
            library.add(faPodcast, faRss, faTelegramPlane, faEnvelope);
        }
    }
</script>

<style lang="scss" scoped>
    a {
        @apply text-white font-normal text-4xl mx-8;
    }
</style>