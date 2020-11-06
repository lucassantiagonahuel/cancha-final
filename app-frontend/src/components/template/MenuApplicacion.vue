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

                <router-link to="/soporte" class="nav-item nav-link">
                    SOPORTE
                </router-link>

            </b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">

                <!-- Using 'button-content' slot -->
                <button @click="cerrarSesion" style="background-color: #000;">
                    <img src="img/apagado.png" alt="" style="width: 30px;">
                </button>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</div>
</template>

<script>
const axios = require('axios');

import
API_URL
from '@/servicios/Api.js'

export default {
    name: 'MenuApplicacion',
    data() {
        return {
            publicPath: process.env.BASE_URL,
            user: {},
        };
    },
    methods: {
        cerrarSesion: async function () {
            let response = await axios.post(API_URL + 'cerrarSession', {
                jwt_token: localStorage.getItem("jwt_token")
            });

            location.href = "/"
        }
    },
    components: {

    }
}
</script>
