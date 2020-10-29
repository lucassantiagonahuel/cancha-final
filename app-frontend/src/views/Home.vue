<template>
<div>
    <!-- MENU -->
    <MenuApplicacion></MenuApplicacion>
    <!-- FIN MENU -->

    <main id="main-wrapper">

        <div class="container" id="contenedor_view">
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="title-view">Bienvenido.</h2>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-12" style="background-color: hsl(5, 74%, 55%)">
                    <h1 class="text-center text-white" >Modulos del sistema</h1>
                </div>
            </div>

            <div class="row mt-5 justify-content-center">
                <div class="col-3">
                    <div>
                        <b-card title="Clientes"img-src="/img/clientela.png" img-alt="Image" img-top tag="article" style="max-width: 20rem;" class="mb-2 text-danger text-uppercase">
                            <b-card-text>
                                <strong class="text-dark">Modulo de clientes, agregar editar y eliminar.</strong>
                            </b-card-text>

                            <div style="text-align: center">
                                <router-link to="/clientes" class="btn btn-danger">
                                    Ir al modulo
                                </router-link>
                            </div>

                        </b-card>
                    </div>
                </div>
                <div class="col-3">
                    <div>
                        <b-card title="Turnos" img-src="/img/turnosCancha.png" img-alt="Image" img-top tag="article" style="max-width: 20rem;" class="mb-2 text-danger text-uppercase">
                            <b-card-text>
                                <strong class="text-dark">Modulo de turnos, agregar editar y eliminar.</strong>
                            </b-card-text>

                            <div style="text-align: center">
                                <router-link to="/turnos" class="btn btn-danger">
                                    Ir al modulo
                                </router-link>
                            </div>
                        </b-card>
                    </div>
                </div>
                <div class="col-3">
                    <div>
                        <b-card title="Caja" img-src="/img/caja-registradora.png" img-alt="Image" img-top tag="article" style="max-width: 20rem;" class="mb-2 text-danger text-uppercase">
                            <b-card-text>
                                <strong class="text-dark">Modulo de caja, agregar editar y eliminar.</strong>
                            </b-card-text>

                            <div style="text-align: center">
                                <router-link to="/caja" class="btn btn-danger">
                                    Ir al modulo
                                </router-link>
                            </div>
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
    name: 'Home',
    components: {
        MenuApplicacion
    }
}
</script>
