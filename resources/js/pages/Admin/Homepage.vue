<template>
    <section class="admin flex-col md:flex-row">
        <aside class="w-full lg:w-1/3 md:w-1/2">
            <episode-index></episode-index>
        </aside>

        <main class="">

        </main>
    </section>
</template>

<script>

    import UserAccessor from "../../mixins/UserAccessor";
    import Constants from "../../Constants";
    import EpisodeIndex from "../../components/EpisodeIndex";

    export default {
        name: "Homepage",
        components: {EpisodeIndex},
        mixins: [UserAccessor],

        created() {
            if(!this.isLogged) {
                this.$router.push({name: Constants.ROUTE_ADMIN_LOGIN});
            }
        }
    }
</script>

<style lang="scss" scoped>
    .admin {
        @apply h-full flex;

        aside {
            @apply h-full;
            overflow:auto;
        }
    }
</style>