import { createNamespacedHelpers } from 'vuex'
const { mapGetters, mapActions } = createNamespacedHelpers('episode');

export default {

    mounted() {
        this.init(
            this.$route.params.slug
        )
    },
    
    computed: {
        ...mapGetters([
            'episode'
        ]),
    },

    methods: {
        ...mapActions([
            'init',
        ]),
    }
}