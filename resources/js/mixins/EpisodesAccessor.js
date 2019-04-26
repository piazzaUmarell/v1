import { createNamespacedHelpers } from 'vuex'
const { mapGetters, mapActions } = createNamespacedHelpers('episodes');

export default {
    created() {
        this.init(
            this.$route.query.page
        );
    },

    computed: {
        ...mapGetters([
            'episodes',
            'latestEpisode',
            'isFirstPage',
            'isLastPage',
            'currentPage',
            'lastPage',
            'urlForPage'
        ]),
    },

    methods: {
        ...mapActions([
            'refresh',
            'init',
            'first',
            'last',
            'next',
            'previous',
            'page',
            'filter',
            'applyKeywords'
        ]),
    }
}