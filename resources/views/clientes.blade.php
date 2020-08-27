@extends('master')

@section('title', 'Clientes')

@section("style")
@endsection

@section('contenido')
  <div class="container" id="contenedor_view">
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
        </div>
      </div>
  </div>
@endsection

@section("modals")
@endsection

@section("js_code")
@endsection