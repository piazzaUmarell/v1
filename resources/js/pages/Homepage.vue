<template>
    <main>
        <main-header
                title="Piazza Umarell"
                subtitle="Il podcast per pezzi di nerd"
                disclaimer="Prossimo episodio: Domenica! Ogni due domeniche!"
        >
            <latest-episode></latest-episode>

            <section class="footer" slot="footer">
                <social-links></social-links>
            </section>
        </main-header>
        <episode-index></episode-index>
    </main>
</template>

<script>
    import MainHeader from "../components/MainHeader";
    import LatestEpisode from "../components/LatestEpisode";
    import EpisodeIndex from "../components/EpisodeIndex";
    import SocialLinks from "../components/SocialLinks";

    export default {
        name: "Homepage",
        components: {SocialLinks, EpisodeIndex, LatestEpisode, MainHeader},
    }
</script>

<style lang="scss" scoped>
    .footer {
        @apply flex flex-row justify-center mt-16 pin-b w-full pt-4;
        background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo-light"));
    }
</style>