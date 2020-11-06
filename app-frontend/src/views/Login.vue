<template>
<div style="background-color: hsl(5, 74%, 55%)">
    <main id="main-wrapper">

        <div class="container" id="contenedor_view">
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="title-view text-center">Ingreso.</h2>
                </div>
            </div>

            <div class="row mt-3 justify-content-center">
                <div class="col-4">

                    <div>
                        <b-card style="width: 100%" class="mb-2">
                            <div style="text-align: center">
                                <img src="img/logo_login.png" alt="" width="150">
                            </div>

                            <b-form @submit="ingresarLogin">
                                <b-form-group id="input-group-1" label="Correo:" label-for="correo">
                                    <b-form-input id="correo" type="text" placeholder="Ingrese su correo" v-model="correo"></b-form-input>
                                </b-form-group>

                                <b-form-group id="input-group-2" label="Contraseña:" label-for="password">
                                    <b-form-input type="password" id="password" placeholder="Ingrese su contraseña" v-model="password"></b-form-input>
                                </b-form-group>

                                <div style="text-align: center;">
                                    <b-button type="submit" variant="danger">INGRESAR</b-button>
                                </div>
                            </b-form>
                        </b-card>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
</template>

<script>
// @ is an alias to /src
import MenuApplicacion from '@/components/template/MenuApplicacion.vue'

import
API_URL
from '@/servicios/Api.js'

const axios = require('axios');

export default {
    name: 'Login',
    components: {
        MenuApplicacion
    },
    data() {
        return {
            correo: "administrador@gmail.com",
            password: "123456",
        }
    },
    methods: {
        ingresarLogin: async function (evt) {
            evt.preventDefault()

            let params = {
                correo: this.correo,
                password: this.password
            }

            let response = await axios.post(API_URL + 'login', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                localStorage.setItem("jwt_token", respuesta_servidor.data)
                location.href = "/inicio";
            } else {
                let mensajes_errores = "";

                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                }

                alert(mensajes_errores);
            }
        }
    }
}
</script>
