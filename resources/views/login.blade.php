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
 
<div class="container" style="margin-top: 200px"> 
    <div class="row">
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" >
                <div class="card-body">
                    <form method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="correo">CORREO</label>
                            <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelp" placeholder="Ingresar correo">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Ingresar contraseña">
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary">INGRESAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>