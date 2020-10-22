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
                <div class="col-12">
                    <h3 class="text-center">Modulos del sistema</h3>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-4">
                    <div>
                        <b-card title="Clientes" img-src="/img/cliente.png" img-alt="Image" img-top tag="article" style="max-width: 20rem;" class="mb-2">
                            <b-card-text>
                                Modulo de clientes, agregar editar y eliminar.
                            </b-card-text>

                            <div style="text-align: center">
                                <router-link to="/clientes" class="btn btn-primary">
                                    Ir al modulo
                                </router-link>
                            </div>

                        </b-card>
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <b-card title="Turnos" img-src="https://picsum.photos/600/300/?image=25" img-alt="Image" img-top tag="article" style="max-width: 20rem;" class="mb-2">
                            <b-card-text>
                                Modulo de clientes, agregar editar y eliminar.
                            </b-card-text>

                            <div style="text-align: center">
                                <router-link to="/turnos" class="btn btn-primary">
                                    Ir al modulo
                                </router-link>
                            </div>
                        </b-card>
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <b-card title="Caja" img-src="https://picsum.photos/600/300/?image=25" img-alt="Image" img-top tag="article" style="max-width: 20rem;" class="mb-2">
                            <b-card-text>
                                Modulo de clientes, agregar editar y eliminar.
                            </b-card-text>

                            <div style="text-align: center">
                                <router-link to="/caja" class="btn btn-primary">
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
