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

                            <b-form>
                                <b-form-group id="input-group-1" label="Correo:" label-for="correo">
                                    <b-form-input id="correo" type="email" required placeholder="Ingrese su correo"></b-form-input>
                                </b-form-group>

                                <b-form-group id="input-group-2" label="Contraseña:" label-for="password">
                                    <b-form-input type="password" id="password" required placeholder="Ingrese su contraseña"></b-form-input>
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

export default {
    name: 'Login',
    components: {
        MenuApplicacion
    }
}
</script>
