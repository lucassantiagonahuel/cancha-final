<template>
<div>
    <b-navbar toggleable="lg" type="dark" variant="info" style="background-color: #000 !important;">
        <b-navbar-brand href="#">
            <router-link to="/" class="nav-item nav-link">
                <img src="img/logo.png" alt="" style="width: 50px;">
            </router-link>
        </b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
                <router-link to="/inicio" class="nav-item nav-link">
                    INICIO
                </router-link>

                <router-link to="/clientes" class="nav-item nav-link">
                    CLIENTES
                </router-link>

                <router-link to="/turnos" class="nav-item nav-link">
                    TURNOS
                </router-link>

                <router-link to="/caja" class="nav-item nav-link">
                    CAJA
                </router-link>

            </b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">

                <!-- Using 'button-content' slot -->
                <router-link to="/" class="nav-item nav-link">
                    <img src="img/apagado.png" alt="" style="width: 30px;">
                </router-link>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</div>
</template>

<script>
export default {
    name: 'MenuApplicacion',
    data() {
        return {
            publicPath: process.env.BASE_URL,
            user: {},
        };
    },
    components: {

    }
}
</script>
