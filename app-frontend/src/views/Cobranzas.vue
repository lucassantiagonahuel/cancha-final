<template>
<div>
    <!-- MENU -->
    <MenuApplicacion></MenuApplicacion>
    <!-- FIN MENU -->

    <main id="main-wrapper">

        <!-- HEADER -->
        <HeaderApplication></HeaderApplication>
        <!-- FIN HEADER -->

        <!-- BOTTOM NAV -->
        <MenuAbajoApplication></MenuAbajoApplication>
        <!-- FIN BOTTOM NAV -->

        <div class="container" id="contenedor_view">
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="title-view">Clientes.</h2>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                </div>
            </div>
        </div>

    </main>
</div>
</template>

<script>
// @ is an alias to /src
import MenuApplicacion from '@/components/template/MenuApplicacion.vue'
import HeaderApplication from '@/components/template/HeaderApplication.vue'
import MenuAbajoApplication from '@/components/template/MenuAbajoApplication.vue'

export default {
    name: 'Cobranzas',
    components: {
        MenuApplicacion,
        HeaderApplication,
        MenuAbajoApplication
    }
}
</script>
