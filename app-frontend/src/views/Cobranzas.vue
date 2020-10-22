<template>
<div>
    <!-- MENU -->
    <MenuApplicacion></MenuApplicacion>
    <!-- FIN MENU -->

    <main id="main-wrapper">

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

export default {
    name: 'Cobranzas',
    components: {
        MenuApplicacion
    }
}
</script>
