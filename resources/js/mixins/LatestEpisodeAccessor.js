import { createNamespacedHelpers } from 'vuex'
const { mapGetters, mapActions } = createNamespacedHelpers('latestEpisode');

export default {
    created() {
        this.init();
    },

    computed: {
        ...mapGetters([
            'latest',
        ]),
    },

    methods: {
        ...mapActions([
            'init',
        ]),
    }
}