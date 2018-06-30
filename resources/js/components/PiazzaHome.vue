<template>
    <main class="bg-grey-lightest">
        <piazza-topbar id="topbar">
            <template slot="title">
                {{ this.$ENV.podcast_title }}
            </template>
        </piazza-topbar>

        <piazza-splash id="splash">
            <template slot="title">
                {{ this.$ENV.podcast_title }}
            </template>
            <template slot="description">
                {{ this.$ENV.podcast_description }}
            </template>
            <template slot="caption">
                {{ this.$ENV.podcast_caption }}
            </template>
        </piazza-splash>
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