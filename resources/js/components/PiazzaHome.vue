<template>
    <main>
        <piazza-topbar id="topbar" />
        <piazza-splash id="splash" scroll-to="#latest" />
        <piazza-latest id="latest" />
        <piazza-playlist id="playlist" />
    </main>
</template>

<script>
    import PiazzaTopbar from './PiazzaTopbar';
    import PiazzaSplash from './PiazzaSplash';
    import PiazzaPlaylist from './PiazzaPlaylist';
    import PiazzaLatest from './PiazzaLatest';

    export default {
        components: {
            PiazzaTopbar,
            PiazzaSplash,
            PiazzaPlaylist,
            PiazzaLatest
        }
    }
</script>