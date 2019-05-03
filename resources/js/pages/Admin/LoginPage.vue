<template>
    <main>
        <main-header
            title="Uffico Umarell"
            subtitle="Il backoffice dei pezzi di nerd."
        >
            <admin-login-form></admin-login-form>
        </main-header>
    </main>
</template>

<script>
    import AdminLoginForm from "../../components/Admin/AdminLoginForm";
    import MainHeader from "../../components/MainHeader";
    export default {
        name: "AdminLoginPage",
        components: {MainHeader, AdminLoginForm}
    }
</script>

<style scoped>

</style>