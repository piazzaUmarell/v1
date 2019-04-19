<template>
    <main>
        <main-header
                title="Piazza Umarell"
                subtitle="Il podcast per pezzi di nerd"
                disclaimer="Prossimo episodio: Domenica! Ogni due domeniche!"
        >
            <latest-episode></latest-episode>
        </main-header>
        <episode-index></episode-index>
    </main>
</template>

<script>
    import MainHeader from "../components/MainHeader";
    import LatestEpisode from "../components/LatestEpisode";
    import EpisodeIndex from "../components/EpisodeIndex";

    export default {
        name: "Homepage",
        components: {EpisodeIndex, LatestEpisode, MainHeader}
    }
</script>

<style scoped>

</style>