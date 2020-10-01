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
                    <h2 class="title-view">Caja.</h2>
                    <button class="btn btn-danger float-right" v-on:click=apreta()>Egreso Dinero</button>
                    <button class="btn btn-danger float-right">Ingreso Dinero</button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <table class="table" id="listado">
                        <thead>
                            <tr>
                                <th bgcolor="#FF3F2C"> Id </th>
                                <th bgcolor="#FF3F2C"> Descripcion </th>
                                <th bgcolor="#FF3F2C"> Id_Turno </th>
                                <th bgcolor="#FF3F2C"> Total </th>
                                <th bgcolor="#FF3F2C"> Fecha </th>
                                <th bgcolor="#FF3F2C"> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(caja,index) in caja">
                                <td>{{caja.id}}</td>
                                <td>{{caja.descripcion}}</td>
                                <td>{{caja.id_turno}}</td>
                                <td>{{caja.total}}</td>
                                <td>{{caja.fecha}}</td>
                                <td>
                                    <button class="btn btn-info">Editar</button>
                                    &nbsp;&nbsp;
                                    <button class="btn btn-danger" v-on:click="eliminarCliente">Eliminar</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
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

import
API_URL
from '@/servicios/Api.js'

console.log(API_URL)

const axios = require('axios');

export default {
    name: 'Caja',
    components: {
        MenuApplicacion,
        HeaderApplication,
        MenuAbajoApplication
    },
    data: function () {

        return {
            caja: [],
            nombre: ""
        }
    },
    methods: {

        // listaCaja: async function () {

        //     let params = {}
        //     let response = await axios.post(API_URL + 'caja', params);
        //     this.caja = response.data

        //     this.obtenerCaja();
        // },

        // altaCaja: async function () {
        //     let params = {
        //         descripcion: "Botella de agua",
        //         id_turno: "20",
        //         total: "600",
        //         fecha: "2020/9/30",
        //     }

        //     let response = await axios.post(API_URL + 'clientes/store', params);
        // },

        // modificarCaja: async function () {
        //     let params = {
        //         id: 1002,
        //         descripcion: "Botella de cerveza",
        //         id_turno: "20",
        //         total: "700",
        //         fecha: "2020/9/30",
        //     }

        //     let response = await axios.post(API_URL + 'caja/edit', params);
        // },

        // obtenerCaja: async function () {
        //     let params = {
        //         id: 1002,
        //     }

        //     let response = await axios.post(API_URL + 'caja/get', params);

        //     let respuesta_servidor = response.data;

        //     if (respuesta_servidor.response == true) {
        //         alert("EL CLIENTE EXISTE MOSTRAR LOS DATOS EN EL MODAL DE EDICION");
        //     } else {
        //         let mensajes_errores = "";

        //         for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
        //             mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
        //         }

        //         alert(mensajes_errores);
        //     }
        // },

        // eliminarCaja: async function () {
        //     let params = {
        //         id: 101
        //     }

        //     let response = await axios.post(API_URL + 'caja/delete', params);
        // },
        // apreta: function(){
        //     console.log("ANDA BIEN")
            
        // }
    },
    // mounted: function () {
    //     this.listaCaja();
    // }



}
</script>
