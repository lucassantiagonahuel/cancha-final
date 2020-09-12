<template>
<header class="navbar navbar-rigth navbar-dark navbar-full doc-navbar-default" id="navbar_superior">
    <span class="navbar-brand mr-auto">
        <a style="padding-right: 14px;display: none;" id="accion_volver">
            <img src="`+flecha_volver+`" alt="">
        </a>
        <img src="img/logo.png" alt="" style="max-width: 100px;width: 50px">
    </span>
    <button class="navbar-toggler" id="btn_superior_hamburguesa"><span class="navbar-toggler-icon" style="padding-top: 9px;"></span></button>

</header>
</template>

<script>
export default {
    name: 'HeaderApplication',
    components: {

    }
}
</script>
