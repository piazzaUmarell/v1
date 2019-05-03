import { createNamespacedHelpers } from 'vuex'
import Constants from "../Constants";
const { mapGetters, mapActions } = createNamespacedHelpers('user');

export default {

    created() {
        this.init().then(
            (response) => {
                if(this.$router.currentRoute.name === Constants.ROUTE_ADMIN_LOGIN) {
                    this.$router.push({name: Constants.ROUTE_ADMIN_HOME});
                }
            }
        );
    },

    computed: {
        ...mapGetters([
            'token',
            'refreshToken',
            'isLogged',
        ]),
    },

    methods: {
        ...mapActions([
            'login',
            'refresh',
            'init'
        ]),
    }
}