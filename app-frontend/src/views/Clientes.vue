<template>
<div>
    <!-- MENU -->
   <!-- <MenuApplicacion></MenuApplicacion>
    <!-- FIN MENU -->

    <main id="main-wrapper">

        <!-- HEADER -->
   <!--     <HeaderApplication></HeaderApplication>
        <!-- FIN HEADER -->

        <!-- BOTTOM NAV -->
   <!--     <MenuAbajoApplication></MenuAbajoApplication>
        <!-- FIN BOTTOM NAV -->

        <div class="container" id="contenedor_view">
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="title-view">Clientes.</h2>
                </div>
            </div>

            <div class="row mt-3">      
                                          
                <div class="col-12">
                    <button class="btn btn-primary mb-3"> Nuevo Cliente </button>
                    <table class="table" id="listado">
                        <thead>
                            <tr>
                                <th bgcolor="#FF3F2C"> Id </th>
                                <th bgcolor="#FF3F2C"> Nombre </th>
                                <th bgcolor="#FF3F2C"> Apellido </th>
                                <th bgcolor="#FF3F2C"> Telefono </th>
                                <th bgcolor="#FF3F2C"> Domicilio </th>
                                <th bgcolor="#FF3F2C"> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(cliente,index) in clientes" :key="cliente.id">
                                <td>{{cliente.id}}</td>
                                <td>{{cliente.nombre}}</td>
                                <td>{{cliente.apellido}}</td>
                                <td>{{cliente.telefono}}</td>
                                <td>{{cliente.domicilio}}</td>
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
    name: 'Clientes',
    components: {
        MenuApplicacion,
        HeaderApplication,
        MenuAbajoApplication
    },
    data: function () {

        return {
            clientes: [],
            nombre: ""
        }
    },
    methods: {

        listaClientes: async function () {

            let params = {}
            let response = await axios.post(API_URL + 'clientes', params);
            this.clientes = response.data

            this.obtenerCliente();
        },

        altaCliente: async function () {
           let params = {
                nombre: "Pedro",
                apellido: "Gomez",
                telefono: "9999999",
                domicilio: "Urquiza 100",
            }
    
            let response = await axios.post(API_URL + 'clientes/store', params);
        },

        modificarCliente: async function () {
            let params = {
                id: 1002,
                nombre: "Pedro EDITADO",
                apellido: "Gomez EDITADO",
                telefono: "9999999 EDITADO",
                domicilio: "Urquiza 100 EDITADO",
            }

            let response = await axios.post(API_URL + 'clientes/edit', params);
        },

        obtenerCliente: async function () {
            let params = {
                id: 1002,
            }

            let response = await axios.post(API_URL + 'clientes/get', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                alert("EL CLIENTE EXISTE MOSTRAR LOS DATOS EN EL MODAL DE EDICION");
            } else {
                let mensajes_errores = "";

                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                }

                alert(mensajes_errores);
            }
        },

        eliminarCliente: async function () {
            let params = {
                id: 101
            }

            let response = await axios.post(API_URL + 'clientes/delete', params);
        }
    },
    mounted: function () {
        this.listaClientes();
    }
}


</script>
