<template>
<div>
    <MenuApplicacion></MenuApplicacion>

    <main id="main-wrapper">

        <div class="container" id="contenedor_view">
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="title-view">Turnos.</h2>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 mb-3">
                    <button class="btn btn-primary" @click="abrirModalAgregar()">
                        Agregar
                    </button>
                </div>
                <div class="col-12">
                    <div>
                        <b-card title="Filtro">
                            <form @submit="filtrarTurnos">

                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="fecha_desde">Desde</label>
                                        <input type="text" class="form-control" id="fecha_desde" v-model="fechaDesdeFiltro">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="fecha_hasta">Hasta</label>
                                        <input type="text" class="form-control" id="fecha_hasta" v-model="fechaHastaFiltro">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="">&nbsp;</label><br>
                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </b-card>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <table class="table table-hover table-dark" id="listado">
                        <thead>
                            <tr>
                                <th bgcolor="#FF3F2C"> Id </th>
                                <th bgcolor="#FF3F2C"> Cliente </th>
                                <th bgcolor="#FF3F2C"> Precio </th>
                                <th bgcolor="#FF3F2C"> Desde </th>
                                <th bgcolor="#FF3F2C"> Hasta </th>
                                <th bgcolor="#FF3F2C"> Creación</th>
                                <th bgcolor="#FF3F2C"> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(turno,index) in turnos">
                                <td>{{turno.id}}</td>
                                <td>{{turno.clientes_nombre+" "+turno.clientes_apellido}}</td>
                                <td>$ {{turno.precio}}</td>
                                <td>{{turno.fecha_desde_esp}}</td>
                                <td>{{turno.fecha_hasta_esp}}</td>
                                <td>{{turno.fecha_creacion_esp}}</td>
                                <td>
                                    <b-button class="btn btn-info" @click="abrirModalEditar(turno.id)">
                                         <b-icon icon="pencil-square">Editar</b-icon>
                                    </b-button>
                                    &nbsp;&nbsp;
                                    <b-button class="btn btn-danger" @click="abrirModalEliminar(turno.id)">
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
            <b-form-input v-model="cliente_id_agregar" placeholder="ID CLIENTE"></b-form-input>
            <b-form-input v-model="precio_agregar" placeholder="PRECIO" class="mt-2"></b-form-input>
            <b-form-input v-model="fecha_hora_desde_agregar" placeholder="FECHA HORA DESDE" class="mt-2"></b-form-input>
            <b-form-input v-model="fecha_hora_hasta_agregar" placeholder="FECHA HORA HASTA" class="mt-2"></b-form-input>
        </div>
        <b-button class="mt-2" variant="outline-success" block @click="agregarTurno()">Guardar</b-button>
    </b-modal>

    <b-modal id="modal_editar" ref="modal_editar" hide-footer title="Editar">
        <div class="d-block text-center">
            <b-form-group label="Cliente:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="cliente_id_editar" placeholder="ID CLIENTE"></b-form-input>
            </b-form-group>

            <b-form-group label="Precio:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="precio_editar" placeholder="PRECIO" class="mt-2"></b-form-input>
            </b-form-group>
            

            <b-form-group label="DESDE:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="fecha_hora_desde_editar" placeholder="FECHA HORA DESDE" class="mt-2"></b-form-input>
            </b-form-group>

            <b-form-group label="HASTA:" label-for="input-vertical" label-align="left">
                <b-form-input v-model="fecha_hora_hasta_editar" placeholder="FECHA HORA HASTA" class="mt-2"></b-form-input>
            </b-form-group>
        </div>
        <b-button class="mt-2" variant="outline-success" block @click="editarTurno()">Guardar</b-button>
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
        <b-button class="mt-2" variant="outline-danger" block @click="eliminarTurno()">Aceptar</b-button>
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
    name: 'Turnos',
    components: {
        MenuApplicacion,
    },
    data: function () {

        return {
            turnos: [],

            cliente_id_agregar: "",
            precio_agregar: "",
            fecha_hora_desde_agregar: "",
            fecha_hora_hasta_agregar: "",

            cliente_id_editar: "",
            precio_editar: "",
            fecha_hora_desde_editar: "",
            fecha_hora_hasta_editar: "",

            id_a_editar: "",
            id_a_eliminar: "",

            fechaDesdeFiltro: "01/01/2020",
            fechaHastaFiltro: "01/12/2020",
        }
    },
    methods: {

        abrirModalAgregar() {

            this.cliente_id_agregar = "";
            this.precio_agregar = "";
            this.fecha_hora_desde_agregar = "";
            this.fecha_hora_hasta_agregar = "";

            this.$refs['modal_agregar'].show()
        },

        agregarTurno: async function () {

            let params = {
                cliente_id: this.cliente_id_agregar,
                precio: this.precio_agregar,
                fecha_hora_desde: this.fecha_hora_desde_agregar,
                fecha_hora_hasta: this.fecha_hora_hasta_agregar,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let response = await axios.post(API_URL + 'turnos/store', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.$refs['modal_agregar'].hide()
                this.listaTurnos();
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

            let response = await axios.post(API_URL + 'turnos/get', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.id_a_editar = id_a_editar;

                this.cliente_id_editar = respuesta_servidor.data.cliente_id;
                this.precio_editar = respuesta_servidor.data.precio;
                this.fecha_hora_desde_editar = respuesta_servidor.data.fecha_desde_esp;
                this.fecha_hora_hasta_editar = respuesta_servidor.data.fecha_hasta_esp;

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

        editarTurno: async function () {

            let params = {
                id: this.id_a_editar,
                cliente_id: this.cliente_id_editar,
                precio: this.precio_editar,
                fecha_hora_desde: this.fecha_hora_desde_editar,
                fecha_hora_hasta: this.fecha_hora_hasta_editar,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let response = await axios.post(API_URL + 'turnos/edit', params);

            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {
                this.$refs['modal_editar'].hide()
                this.listaTurnos();
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

        eliminarTurno: async function () {

            let params = {
                id: this.id_a_eliminar,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let response = await axios.post(API_URL + 'turnos/delete', params);

            let respuesta_servidor = response.data;

            this.$refs['modal_eliminar'].hide();

            if (respuesta_servidor.response == true) {
                this.listaTurnos();
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

        listaTurnos: async function () {

            let params = {
                fechaDesde: this.fechaDesdeFiltro,
                fechaHasta: this.fechaHastaFiltro,
                jwt_token: localStorage.getItem("jwt_token")
            }

            let response = await axios.post(API_URL + 'turnos', params);
            let respuesta_servidor = response.data;

            if (respuesta_servidor.response == true) {

                this.turnos = respuesta_servidor.data
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

        filtrarTurnos: function (evt) {
            evt.preventDefault()

            if (this.validateFechaEsp(this.fechaDesdeFiltro) && this.validateFechaEsp(this.fechaHastaFiltro)) {
                this.listaTurnos()
            } else {
                alert("Verifique las fechas ingresadas")
            }
        },

        validateFechaEsp: function (fecha) {

            let partes_fecha = fecha.split("/")

            if (partes_fecha.length == 3) {
                let dia = parseInt(partes_fecha[0])
                let mes = parseInt(partes_fecha[1])
                let anio = parseInt(partes_fecha[2])

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
        this.listaTurnos();
    }
}
</script>
