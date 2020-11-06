<template>
<div>
        <div>
        <MenuApplicacion></MenuApplicacion>
    </div>

    <div class="jumbotron">
        <h1 class="display-4">Contactanos</h1>
        <p class="lead"></p>
        <hr class="my-4">
        <p>Lucas Nahuel</p>
        <p>Mario Olivera</p>
        <p>Alejandro Diaz</p>
        <a class="btn btn-primary btn-lg" href="https://wa.link/zuputg" role="button">Whatsapp</a>
    </div>
    <div>
        <VueTailwindPicker
            @change="(v) => checkin = v"
        >
            <input type="text" v-model="checkin" />
        </VueTailwindPicker>
    </div>


</div>
</template>

<script>
import MenuApplicacion from "@/components/template/MenuApplicacion.vue";
import API_URL from "@/servicios/Api.js";
const axios = require("axios");
export default {
  name: "Soporte",
  components: {
    MenuApplicacion,
    VueTailwindPicker
  },
  data: function () {
    return {checkin:""};
  },
};
</script>


