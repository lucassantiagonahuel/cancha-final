<template>
<div>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <div>
        <MenuApplicacion></MenuApplicacion>
    </div>

    <div class="jumbotron">
        <h1 class="display-4">Contactanos</h1>
        <p class="lead"></p>
        <hr class="my-4">
        <p>Lucas Nahuel - lucassantiagonahuel@gmail.com</p>
        <p>Mario Olivera - marioelgordombabyolivera@tinder.com</p>
        <p>Alejandro Diaz - diazale94@outlook.com</p>
  
        <a href="https://wa.link/zuputg" class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>
        
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
  },
  data: function () {
    return {};
  },
};
</script>


