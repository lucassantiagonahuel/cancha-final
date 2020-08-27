<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestion de Cancha</title>

    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/propio.css')}}">
  
  <style type="text/css">
  * { 
      padding:0px;
      margin:0px;
  }

  #header {
    margin:auto;
    width:500px;
    font-family:sans-serif;
  }

  ul,ol{
    list-style:none;
  }

  .nav li a {
    background-color:black;
    color:white;
    text-decoration:none;
    padding:10px 15px;
    display:block;

  }
  .nav li a:hover {
    background-color:#434343;
  }

  .nav > li {
    float:left;
  }

  .nav li ul {
    display:none;
    position:absolute;
    min-width:140px; 
  }

  .nav li:hover > ul {
    display:block;
  }

  </style>
</head>
<body>
<div id="cabecera">
    <p style="color:white";>SISTEMA DE GESTION DE CANCHA FUTBOL 5</p>
</div>

<div id="header">
  
  <ul class="nav">
    <li><a href="#"> CLIENTES </a>
      <ul>
        <li><a href="{{url('/clientes')}}">Registrar Cliente</a></li>
        <li><a href="{{url('/clientes')}}">Gestion de Clientes</a></li>
      </ul>
      </li>
    
    <li><a href="#"> TURNOS </a>
       <ul>
        <!--<li><a href="gesttur.php">Turnos Reservados</a></li>  -->
        <li><a href="{{url('/turnos')}}">Registrar Turno</a></li>
        <li><a href="{{url('/turnos')}}">Gestion de turnos</a></li>
      </ul>
      </li>

    <li><a href="#"> COBRANZAS </a>
       <ul>
          <li><a href="{{url('/cobranzas')}}">Nuevo Cobro</a></li>
        </ul>
        </li>    
    <li>
    <a href="{{url('/soporte')}}"> SOPORTE </a></li> 
   


  </ul>
 
<div class="container" style="margin-top: 200px"> 
    <div class="row">
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">CLIENTES</h5>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>