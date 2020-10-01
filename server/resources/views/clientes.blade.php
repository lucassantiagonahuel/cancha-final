@extends('master')

@section('title', 'Clientes')

@section("style")
@endsection

@section('contenido')
  <div class="container" id="contenedor_view">
      <div id="app">
        <div class="row mt-3">
          <div class="col-12">
            <h2 class="title-view">Clientes.</h2>
          </div>
        </div>



        <div class="row mt-3">
          <div class="col-12">
            <table class="table">
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
              <tbody >
                <tr v-for="(cliente,index) in clientes">
                  <td>{{cliente.id}}</td>
                  <td>{{cliente.nombre}}</td>
                  <td>{{cliente.apellido}}</td>
                  <td>{{cliente.telefono}}</td>
                  <td>{{cliente.domicilio}}</td>
                  <td>
                    <button class="btn btn-info">Editar</button>
                    <button class="btn btn-danger" v-on:click="eliminarCliente" >Eliminar</button>
                  </td>
                </tr>

              </tbody>
            </table>        
          </div>
        </div>
      </div>
  </div>
@endsection

@section("modals")
@endsection

@section("js_code")
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script>

const app = new Vue({
  el: '#contenedor_view', 
  data:
  {
    clientes:[
      {
        id:1,
        nombre: "ALejandro",
        apellido: "Diaz",
        telefono: "213213213",
        domicilio: "asdasdasddas",
      }
    ],
    nombre: ""
  },
  methods:
  {
    
    listaClientes: function()
    {
      const punta = this;
      axios.get('http://localhost/trabajo3/adquirirclientes.php')
      .then (function(response)
      {
        punta.clientes = response.data
      })
    },
    
    altaCliente: function()
    {
      const punta = this;
      axios.get('http://localhost/trabajo3/altacliente.php?nombre='+this.nombre)
      .then(function (response)
      {
        punta.listaClientes();
      })
    },

    eliminarCliente: function()
    {
      const punta = this;
      axios.get('http://localhost/trabajo3/eliminarcliente.php')
      .then(function (response)
      {
        punta.listaClientes;
      })
    }
    */
  },
  mounted: function()
  {
    this.listaClientes();
  }
});
</script>
@endsection