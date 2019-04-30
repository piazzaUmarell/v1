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
    export default {
        name: "SocialLinks"
    }
</script>

<style lang="scss" scoped>
    a {
        @apply text-white font-normal text-5xl mx-8;
    }
</style>