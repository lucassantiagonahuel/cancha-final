<template>
<div>
    <MenuApplicacion></MenuApplicacion>

    <main id="main-wrapper">

        <div class="container" id="contenedor_view">
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="title-view">Clientes.</h2>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 mb-3">
                    <button class="btn btn-primary" @click="abrirModalAgregar()">
                        Nuevo Cliente
                    </button>
                    <br>
                    <input type="text" placeholder="Buscar Cliente..." v-model="busqueda">
                    <button class="btn btn-primary" @click="listaClientes">Buscar</button>
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
                                    <button class="btn btn-info" @click="abrirModalEditar(cliente.id)">Editar</button>
                                    &nbsp;&nbsp;
                                    <button class="btn btn-danger" @click="abrirModalEliminar(cliente.id)">Eliminar</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <b-modal id="modal_agregar" ref="modal_agregar" hide-footer title="Agregar">
        <div class="d-block text-center">
            <b-form-input v-model="nombre_agregar" placeholder="NOMBRE"></b-form-input>
            <b-form-input v-model="apellido_agregar" placeholder="APELLIDO" class="mt-2"></b-form-input>
            <b-form-input v-model="telefono_agregar" placeholder="TELEFONO" class="mt-2"></b-form-input>
            <b-form-input v-model="domicilio_agregar" placeholder="DOMICILIO" class="mt-2"></b-form-input>
        </div>
        <b-button class="mt-2" variant="outline-success" block @click="altaCliente()">Guardar</b-button>
    </b-modal>

    <b-modal id="modal_editar" ref="modal_editar" hide-footer title="Editar">
        <div class="d-block text-center">
            <b-form-group label="Nombre:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="nombre_editar" placeholder="nombre"></b-form-input>
            </b-form-group>

            <b-form-group label="Apellido:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="apellido_editar" placeholder="apellido" class="mt-2"></b-form-input>
            </b-form-group>
            </b-form-group>

            <b-form-group label="Teléfono:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="telefono_editar" placeholder="telefono" class="mt-2"></b-form-input>
            </b-form-group>

            <b-form-group label="Dirección:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="domicilio_editar" placeholder="direccion" class="mt-2"></b-form-input>
            </b-form-group>
        </div>
        <b-button class="mt-2" variant="outline-success" block @click="editarCliente()">Guardar</b-button>
    </b-modal>

    <b-modal id="modal_eliminar" ref="modal_eliminar" hide-footer title="Eliminar">
        <div class="d-block text-center">
            <p>¿Esta seguro desea eliminar el cliente seleccionado?</p>
        </div>
        <b-button class="mt-2" variant="outline-danger" block @click="eliminarCliente()">Aceptar</b-button>
    </b-modal>

</div>
</template>

<script>
// @ is an alias to /src

import MenuApplicacion from '@/components/template/MenuApplicacion.vue'

import
API_URL
from '@/servicios/Api.js'

const axios = require('axios');

export default {
    name: 'Clientes',
    components: {
        MenuApplicacion
    },
    data: function () {

        return {
            clientes: [],

            nombre_agregar: "",
            apellido_agregar: "",
            telefono_agregar: "",
            domicilio_agregar: "",

            nombre_editar: "",
            apellido_editar: "",
            telefono_editar: "",
            domicilio_editar: "",

            id_a_editar: "",
            id_a_eliminar: "",
            nombre_filtrar: "",
            busqueda: "",

        }
    },
    methods: {

        abrirModalAgregar() {

            this.nombre_agregar = "";
            this.apellido_agregar = "";
            this.telefono_agregar = "";
            this.domicilio_agregar = "";

            this.$refs['modal_agregar'].show()
        },

        listaClientes: async function () {

            let params = {
                busqueda: this.busqueda
            }

            console.log(params)

            let response = await axios.post(API_URL + 'clientes', params);
            this.clientes = response.data

            this.obtenerCliente();
        },

        altaCliente: async function () {
            let params = {
                nombre: this.nombre_agregar,
                apellido: this.apellido_agregar,
                telefono: this.telefono_agregar,
                domicilio: this.domicilio_agregar,

            }
            let response = await axios.post(API_URL + 'clientes/store', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.$refs['modal_agregar'].hide()
                this.listaClientes();
            } else {
                let mensajes_errores = "";

                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                }

                alert(mensajes_errores);
            }
        },

        abrirModalEditar: async function (id_a_editar) {

            let params = {
                id: id_a_editar,
            }

            let response = await axios.post(API_URL + 'clientes/get', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.id_a_editar = id_a_editar;

                this.nombre_editar = respuesta_servidor.data.nombre;
                this.apellido_editar = respuesta_servidor.data.apellido;
                this.telefono_editar = respuesta_servidor.data.telefono;
                this.domicilio_editar = respuesta_servidor.data.domicilio;

                this.$refs['modal_editar'].show()
            } else {
                let mensajes_errores = "";

                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                }

                alert(mensajes_errores);
            }
        },

        editarCliente: async function () {
            let params = {
                id: this.id_a_editar,
                nombre: this.nombre_editar,
                apellido: this.apellido_editar,
                telefono: this.telefono_editar,
                domicilio: this.domicilio_editar,
            }

            let response = await axios.post(API_URL + 'clientes/edit', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.$refs['modal_editar'].hide();
                this.listaClientes();
            } else {
                let mensajes_errores = "";

                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                }

                alert(mensajes_errores);
            }

        },

        abrirModalEliminar(id_row_seleccionado) {

            this.id_a_eliminar = id_row_seleccionado;
            this.$refs['modal_eliminar'].show();
        },

        eliminarCliente: async function () {

            let params = {
                id: this.id_a_eliminar
            }

            let response = await axios.post(API_URL + 'clientes/delete', params);

            let respuesta_servidor = response.data;

            this.$refs['modal_eliminar'].hide();

            if (respuesta_servidor.response == true) {
                this.listaClientes();
            } else {
                let mensajes_errores = "";

                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                }

                alert(mensajes_errores);
            }
        },

        //   obtenerCliente: async function () {
        //            let params = {
        //                id: 1002,
        //            }
        //
        //            let response = await axios.post(API_URL + 'clientes/get', params);
        //
        //            let respuesta_servidor = response.data;
        //
        //            if (respuesta_servidor.response == true) {
        //                alert("EL CLIENTE EXISTE MOSTRAR LOS DATOS EN EL MODAL DE EDICION");
        //            } else {
        //                let mensajes_errores = "";
        //
        //                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
        //                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
        //                }

        //                alert(mensajes_errores);
        //            }
        //        },

    },

    mounted: function () {
        this.listaClientes();
    }
}
</script>
