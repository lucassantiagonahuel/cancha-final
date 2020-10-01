<template>
<div id="menu">
    <div aria-hidden="true" class="navdrawer" id="menu_lateral" tabindex="-1">
        <div class="navdrawer-content">
            <div class="navdrawer-header">
                <img src="img/logo.png" alt="" style="width: 100px;">
                <p>CLUB ATLETICO INDEPENDIENTE</p>
            </div>
            <nav class="navdrawer-nav">

                <router-link to="/inicio" class="nav-item nav-link">
                    <img src="img/home-run.svg">INICIO
                </router-link>

                <router-link to="/clientes" class="nav-item nav-link">
                    <img src="img/customer.svg">CLIENTES
                </router-link>

                <router-link to="/turnos" class="nav-item nav-link">
                    <img src="img/sport.svg">TURNOS
                </router-link>

                <router-link to="/caja" class="nav-item nav-link">
                    <img src="img/money.svg">CAJA
                </router-link>

                <router-link to="/inicio" class="nav-item nav-link">
                    <img src="img/logout.svg">CERRAR SESION
                </router-link>
            </nav>

        </div>
    </div>
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
