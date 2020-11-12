<template>
<div>

    <MenuApplicacion></MenuApplicacion>

    <main id="main-wrapper">

        <div class="container" id="contenedor_view">
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="title-view">Caja.</h2>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 mb-3">
                    <button class="btn btn-danger" @click="abrirModalAgregar()">
                        Agregar
                    </button>
                </div>
            </div>

            <div class="col-12">
                <div>
                    <b-card title="Filtro" class="text-uppercase">
                        <form @submit="filtrarCaja">

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="fecha_desde"><strong>Desde</strong></label>
                                    <b-calendar style="width: 100%;" v-model="fechaDesdeFiltro" @context="onContext" locale="es" v-show="true" :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"></b-calendar>
                                </div>
                                <div class="col-md-4">
                                    <label for="fecha_hasta"><strong>Hasta</strong></label>
                                    <b-calendar style="width: 100%;" v-model="fechaHastaFiltro" @context="onContext" locale="es" v-show="true" :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"></b-calendar>
                                </div>
                                <div class="col-md-1">
                                    <label for="">&nbsp;</label><br>
                                    <button type="submit" class="btn btn-outline-danger">Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </b-card>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-4 mb-3">

                    <b-card title="Ventas" class="mb-2 bg-info text-white">
                        <b-card-text>
                            <h3 class="text-white">{{totalVentas}}</h3>
                        </b-card-text>

                    </b-card>
                </div>
                <div class="col-4 mb-3">

                    <b-card title="Gastos" class="mb-2 bg-danger text-white">
                        <b-card-text>
                            <h3>{{totalGastos}}</h3>
                        </b-card-text>

                    </b-card>
                </div>
                <div class="col-4 mb-3">

                    <b-card title="Ganancias" class="mb-2 bg-success text-white">
                        <b-card-text>
                            <h3>{{totalGanancias}}</h3>
                        </b-card-text>

                    </b-card>
                </div>

            </div>
            <div class="row mt-3">

                <div class="col-12">
                    <table class="table table-hover table-dark" id="listado">
                        <thead>
                            <tr>
                                <th bgcolor="#FF3F2C"> Id </th>
                                <th bgcolor="#FF3F2C"> Descripcion </th>
                                <th bgcolor="#FF3F2C"> Turno </th>
                                <th bgcolor="#FF3F2C"> Total </th>
                                <th bgcolor="#FF3F2C"> Fecha </th>
                                <th bgcolor="#FF3F2C"> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in ListadoCaja">
                                <td>{{row.id}}</td>
                                <td>{{row.descripcion}}</td>
                                <td>{{row.id_turno}}</td>
                                <td>
                                    <span v-if="row.total >= 0" class="text-success" style="font-weight: bold;">$ {{row.total}}</span>
                                    <span v-else class="text-danger" style="font-weight: bold;">$ {{row.total}}</span>
                                </td>
                                <td>{{row.fecha_caja}}</td>
                                <td>
                                    <b-button class="btn btn-info" @click="abrirModalEditar(row.id)">
                                        <b-icon icon="pencil-square">Editar</b-icon>
                                    </b-button>
                                    &nbsp;&nbsp;
                                    <b-button class="btn btn-danger" @click="abrirModalEliminar(row.id)">
                                        <b-icon icon="trash-fill">Eliminar</b-icon>
                                    </b-button>
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
            <b-form-input v-model="descripcion_agregar" placeholder="DESCRIPCION" class="mt-2"></b-form-input>
            <b-form-input v-model="total_agregar" placeholder="TOTAL" class="mt-2"></b-form-input>
            <b-form-input v-model="fecha_agregar" placeholder="FECHA" class="mt-2"></b-form-input>
        </div>
        <b-button class="mt-2" variant="outline-success" block @click="agregarCaja()">Guardar</b-button>
    </b-modal>

    <b-modal id="modal_editar" ref="modal_editar" hide-footer title="Editar">
        <div class="d-block text-center">
            <b-form-group label="DESCRIPCION:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="descripcion_editar" placeholder="DESCRIPCION" class="mt-2"></b-form-input>
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
        <b-row class="text-md-center">
            <b-col>
                <b-icon icon="exclamation-circle" animation="throb" font-scale="4" variant="danger"></b-icon>
            </b-col>
        </b-row>
        <b-button class="mt-2" variant="outline-danger" block @click="eliminarCaja()">Aceptar</b-button>
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
    name: 'Caja',
    components: {
        MenuApplicacion,
    },
    data: function () {

        return {
            ListadoCaja: [],

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

            fechaDesdeFiltro: "",
            fechaHastaFiltro: "",

            totalVentas: "Calculando...",
            totalGanancias: "Calculando...",
            totalGastos: "Calculando...",

            fechaDesdeCalendar: '',
            context: null
        }
    },
    methods: {

        onContext(ctx) {
            console.log(ctx)
            this.context = ctx
        },

        abrirModalAgregar() {

            this.caja_id_agregar = "";
            this.descripcion_agregar = "";
            this.total_agregar = "";
            this.fecha_agregar = "";

            this.$refs['modal_agregar'].show()
        },

        agregarCaja: async function () {

            let params = {
                descripcion: this.descripcion_agregar,
                total: this.total_agregar,
                fecha: this.fecha_agregar,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let response = await axios.post(API_URL + 'caja/store', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.$refs['modal_agregar'].hide()
                this.listaCaja();
            } else {
                if (respuesta_servidor.login == false) {
                    location.href = "/";
                } else {
                    let mensajes_errores = "";

                    for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                        mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                    }

                    alert(mensajes_errores);
                }
            }
        },

        abrirModalEditar: async function (id_a_editar) {

            let params = {
                id: id_a_editar,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let response = await axios.post(API_URL + 'caja/get', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.id_a_editar = id_a_editar;

                this.descripcion_editar = respuesta_servidor.data.descripcion;
                this.total_editar = respuesta_servidor.data.total;
                this.fecha_editar = respuesta_servidor.data.fecha;

                this.$refs['modal_editar'].show()
            } else {
                if (respuesta_servidor.login == false) {
                    location.href = "/";
                } else {
                    let mensajes_errores = "";

                    for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                        mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                    }

                    alert(mensajes_errores);
                }
            }
        },

        editarCaja: async function () {

            let params = {
                id: this.id_a_editar,
                descripcion: this.descripcion_editar,
                total: this.total_editar,
                fecha: this.fecha_editar,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let response = await axios.post(API_URL + 'caja/edit', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.$refs['modal_editar'].hide()
                this.listaCaja();
            } else {
                if (respuesta_servidor.login == false) {
                    location.href = "/";
                } else {
                    let mensajes_errores = "";

                    for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                        mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                    }

                    alert(mensajes_errores);
                }
            }
        },

        abrirModalEliminar(id_row_seleccionado) {

            this.id_a_eliminar = id_row_seleccionado;
            this.$refs['modal_eliminar'].show()
        },

        eliminarCaja: async function () {

            let params = {
                id: this.id_a_eliminar,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let response = await axios.post(API_URL + 'caja/delete', params);

            let respuesta_servidor = response.data;

            this.$refs['modal_eliminar'].hide();

            if (respuesta_servidor.response == true) {
                this.listaCaja();
            } else {
                if (respuesta_servidor.login == false) {
                    location.href = "/";
                } else {
                    let mensajes_errores = "";

                    for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                        mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                    }

                    alert(mensajes_errores);
                }
            }
        },

        listaCaja: async function () {

            console.log(this.fechaDesdeFiltro);
            console.log(this.fechaHastaFiltro);

            let params = {
                fechaDesde: this.fechaDesdeFiltro,
                fechaHasta: this.fechaHastaFiltro,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let respuesta_servidor = await axios.post(API_URL + 'caja', params);
            respuesta_servidor = respuesta_servidor.data;

            if (respuesta_servidor.response == true) {

                this.totalVentas = "$ " + respuesta_servidor.data.ventas
                this.totalGanancias = "$ " + respuesta_servidor.data.ganancias
                this.totalGastos = "$ " + respuesta_servidor.data.gastos

                this.ListadoCaja = respuesta_servidor.data.listado_caja;
            } else {
                if (respuesta_servidor.login == false) {
                    location.href = "/";
                } else {
                    let mensajes_errores = "";

                    for (let i = 0; i < respuesta_servidor.messages_errors.length; i++) {
                        mensajes_errores = mensajes_errores + respuesta_servidor.messages_errors[i] + "\n";
                    }

                    alert(mensajes_errores);
                }
            }

        },

        filtrarCaja: function (evt) {
            evt.preventDefault()

            if (this.validateFechaEsp(this.fechaDesdeFiltro) && this.validateFechaEsp(this.fechaHastaFiltro)) {
                this.listaCaja()
            } else {
                alert("Verifique las fechas ingresadas")
            }
        },

        validateFechaEsp: function (fecha) {

            let partes_fecha = fecha.split("-")

            if (partes_fecha.length == 3) {
                let dia = parseInt(partes_fecha[2])
                let mes = parseInt(partes_fecha[1])
                let anio = parseInt(partes_fecha[0])

                if (isNaN(dia) || isNaN(mes) || isNaN(anio)) {
                    return false
                }

                if (dia > 31 || dia < 1) {
                    return false
                }

                if (mes > 12 || mes < 1) {
                    return false
                }

                return true
            } else {
                return false
            }
        }

    },
    mounted: function () {
        this.listaCaja();
    }
}
</script>
