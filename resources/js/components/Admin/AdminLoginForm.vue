<template>
    <section class="login-form w-full lg:w-2/3 xl:w-1/2">
        <form
            @keydown="invalidCredentials = false"
            @submit.prevent="submit"
        >
            <div class="input-container">
                <label for="username">Email: </label>
                <input type="text" id="username" name="username" autocomplete="username" v-model="form.username">
            </div>

            <div class="input-container">
                <label for="password">Password: </label>
                <input type="password" id="password" name="password" autocomplete="current-password" v-model="form.password">
            </div>

            <span class="error" v-if="invalidCredentials">
                <i class="fa fa-exclamation-circle"></i>
                Credenziali non valide
            </span>

            <button type="submit">
                Accedi
                <font-awesome-icon :icon="['fa','sign-in-alt']"></font-awesome-icon>
            </button>
        </form>
    </section>
</template>

<script>
    import { library } from '@fortawesome/fontawesome-svg-core';
    import { faSignInAlt } from '@fortawesome/free-solid-svg-icons';
    import UserAccessor from "../../mixins/UserAccessor";
    import Constants from "../../Constants";

    export default {
        name: "AdminLoginForm",
        mixins: [UserAccessor],

        created() {
            library.add(faSignInAlt)
        },

        data() {
            return {
                invalidCredentials: false,
                form: {
                    username: '',
                    password: '',
                }
            }
        },

        methods: {

            submit() {
                this.login(this.form)
                    .then( response => {
                        this.$router.push({name: Constants.ROUTE_ADMIN_HOME})
                    })
                    .catch( response => {
                        this.invalidCredentials = true;
                    });
            }
        },
    }
</script>

<style lang="scss" scoped>

    .login-form {
        @apply mx-auto p-4 rounded flex flex-col mt-16;

        form {
            @apply relative;

            .input-container {

                @apply mb-4;

                label {
                    @apply block text-sm;
                }

                input {
                    @apply w-full border-b-2 border-blue-darker px-4 pt-2 pb-1 outline-none;
                }
            }

            button {
                @apply absolute pin-r text-white px-4 py-2 rounded border border-white;
                background: linear-gradient(to right, config("colors.blue-dark"), config("colors.indigo"));
            }
        }
    }

</style>