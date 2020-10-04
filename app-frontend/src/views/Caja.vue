<template>
<div>
    // <!-- MENU -->
    // <!--<MenuApplicacion></MenuApplicacion>-->
    // <!-- FIN MENU -->

    <main id="main-wrapper">

        // <!-- HEADER -->
        // <!--<HeaderApplication></HeaderApplication>-->
        // <!-- FIN HEADER -->

        // <!-- BOTTOM NAV -->
        // <!--<MenuAbajoApplication></MenuAbajoApplication>-->
        // <!-- FIN BOTTOM NAV -->

        <div class="container" id="contenedor_view">
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="title-view">Caja.</h2>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 mb-3">
                    <button class="btn btn-primary" @click="abrirModalAgregar()">
                        Agregar
                    </button>
                </div>
                <div class="col-12">
                    <table class="table" id="listado">
                        <thead>
                            <tr>
                                <th bgcolor="#FF3F2C"> Id </th>
                                <th bgcolor="#FF3F2C"> Descripcion </th>
                                <th bgcolor="#FF3F2C"> Total </th>
                                <th bgcolor="#FF3F2C"> Fecha </th>
                                <th bgcolor="#FF3F2C"> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(caja,index) in Caja">
                                <td>{{caja.id}}</td>
                                <td>{{caja.descripcion}}</td>
                                <td>$ {{caja.total}}</td>
                                <td>{{caja.fecha}}</td>
                                <td>
                                    <button class="btn btn-info" @click="abrirModalEditar(caja.id)">Editar</button>
                                    &nbsp;&nbsp;
                                    <button class="btn btn-danger" @click="abrirModalEliminar(caja.id)">Eliminar</button>
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
            <b-form-input v-model="caja_id_agregar" placeholder="ID CLIENTE"></b-form-input>
            <b-form-input v-model="descripcion_agregar" placeholder="DESCRIPCION" class="mt-2"></b-form-input>
            <b-form-input v-model="total_agregar" placeholder="TOTAL" class="mt-2"></b-form-input>
            <b-form-input v-model="fecha_agregar" placeholder="FECHA" class="mt-2"></b-form-input>
        </div>
        <b-button class="mt-2" variant="outline-success" block @click="agregarCaja()">Guardar</b-button>
    </b-modal>

    <b-modal id="modal_editar" ref="modal_editar" hide-footer title="Editar">
        <div class="d-block text-center">
            <b-form-group label="Caja:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="caja_id_editar" placeholder="ID CAJA"></b-form-input>
            </b-form-group>

            <b-form-group label="DESCRIPCION:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="descripcion_editar" placeholder="DESCRIPCION" class="mt-2"></b-form-input>
            </b-form-group>
            </b-form-group>

            <b-form-group label="TOTAL:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="total_editar" placeholder="TOTAL" class="mt-2"></b-form-input>
            </b-form-group>

            <b-form-group label="FECHA:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="fecha_editar" placeholder="FECHA" class="mt-2"></b-form-input>
            </b-form-group>
        </div>
        <b-button class="mt-2" variant="outline-success" block @click="editarCaja()">Guardar</b-button>
    </b-modal>

    <b-modal id="modal_eliminar" ref="modal_eliminar" hide-footer title="Eliminar">
        <div class="d-block text-center">
            <p>¿Esta seguro desea eliminar el registro seleccionado?</p>
        </div>
        <b-button class="mt-2" variant="outline-danger" block @click="eliminarCaja()">Aceptar</b-button>
    </b-modal>

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
            Caja: [],

            caja_id_agregar: "",
           descripcion_agregar: "",
            total_agregar: "",
            fecha_agregar: "",

            caja_id_editar: "",
            descripcion_editar: "",
           total_editar: "",
            fecha_editar: "",

            id_a_editar: "",
            id_a_eliminar: "",
        }
    },
    methods: {

        abrirModalAgregar() {

            this.caja_id_agregar = "";
            this.descripcion_agregar = "";
            this.total_agregar = "";
            this.fecha_agregar = "";

            this.$refs['modal_agregar'].show()
        },

        agregarCaja: async function () {

            let params = {
                caja_id: this.caja_id_agregar,
                descripcion: this.descripcion_agregar,
                total: this.total_agregar,
                fecha: this.fecha_agregar,
            }

            let response = await axios.post(API_URL + 'caja/store', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.$refs['modal_agregar'].hide()
                this.listaTurnos();
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

            let response = await axios.post(API_URL + 'caja/get', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.id_a_editar = id_a_editar;

                this.caja_id_editar = respuesta_servidor.data.caja_id;
                this.descripcion_editar = respuesta_servidor.data.descripcion;
                this.total_editar = respuesta_servidor.data.fecha_desde_esp;
                this.fecha_hora_hasta_editar = respuesta_servidor.data.fecha_hasta_esp;

                this.$refs['modal_editar'].show()
            } else {
                let mensajes_errores = "";

                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                }

                alert(mensajes_errores);
            }
        },

        editarTurno: async function () {

            let params = {
                id: this.id_a_editar,
                cliente_id: this.cliente_id_editar,
                precio: this.precio_editar,
                total: this.fecha_hora_desde_editar,
                fecha: this.fecha_editar,
            }

            let response = await axios.post(API_URL + 'caja/edit', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.$refs['modal_editar'].hide()
                this.listaCaja();
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
            this.$refs['modal_eliminar'].show()
        },

        eliminarTurno: async function () {

            let params = {
                id: this.id_a_eliminar
            }

            let response = await axios.post(API_URL + 'caja/delete', params);

            let respuesta_servidor = response.data;

            this.$refs['modal_eliminar'].hide();

            if (respuesta_servidor.response == true) {
                this.listaCaja();
            } else {
                let mensajes_errores = "";

                for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                    mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                }

                alert(mensajes_errores);
            }
        },

        listaCaja: async function () {

            let params = {}
            let response = await axios.post(API_URL + 'caja', params);
            this.caja = response.data
        }
    },
    mounted: function () {
        this.listaCaja();
    }
}
</script>

