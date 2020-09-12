<template>
<nav id="bottom_nav">
    <router-link to="/clientes" class="nav-item">
        <img src="img/customer.svg"> Clientes
    </router-link>

    <router-link to="/turnos" class="nav-item">
        <img src="img/sport.svg"> Turnos
    </router-link>

    <router-link to="/cobranzas" class="nav-item">
        <img src="img/money.svg"> Cobranzas
    </router-link>
</nav>
</template>

<script>
export default {
    name: 'MenuAbajoApplication',
    components: {

    }
}
</script>
