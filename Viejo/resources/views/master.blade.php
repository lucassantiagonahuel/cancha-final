<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">
    <title>@yield("title") | {{Config("app.name")}}</title>

    <link rel="stylesheet" href="{{ asset('/fonts/Roboto/css.css') }}">
    <link rel="stylesheet" href="{{ asset('/fonts/Material-Icons/icon.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/material-design/css/material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/fonts/Lato-2/lato.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/slideout.css') }}">

    <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/material-design/js/material.min.js') }}"></script>
    <script src="{{ asset('/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('/plugins/moment/es.js') }}"></script>
    <script src="{{ asset('/plugins/slideout/slideout.js') }}"></script>
    <script src="{{ asset('/js/global.js') }}"></script>

    @section("style")
    @show
  </head>
  <body>

    <div id="menu">
      <div aria-hidden="true" class="navdrawer" id="menu_lateral" tabindex="-1">
          <div class="navdrawer-content">
          <div class="navdrawer-header" >
              <img src="{{ asset('/img/logo.png')}}" alt="" style="width: 100px;">
              <p>CLUB ATLETICO INDEPENDIENTE</p>
          </div>
          <nav class="navdrawer-nav">
              <a class="nav-item nav-link" href="{{asset('/')}}"><img src="{{asset('/img/home-run.svg')}}">INICIO</a>
              <a class="nav-item nav-link" href="{{asset('/clientes')}}"><img src="{{asset('/img/customer.svg')}}">CLIENTES</a>
              <a class="nav-item nav-link" href="{{asset('/turnos')}}"><img src="{{asset('/img/sport.svg')}}">TURNOS</a>
              <a class="nav-item nav-link" href="{{asset('/cobranzas')}}"><img src="{{asset('/img/money.svg')}}">COBRANZAS</a>
              <a class="nav-item nav-link" href="{{asset('/cerrar_sesion')}}"><img src="{{asset('/img/logout.svg')}}">CERRAR SESION</a>
          </nav>
          
          </div>
      </div>
    </div>

    <main id="main-wrapper">

      <header class="navbar navbar-rigth navbar-dark navbar-full doc-navbar-default" id="navbar_superior" >
          <span class="navbar-brand mr-auto">
          <a style="padding-right: 14px;display: none;" id="accion_volver">
              <img src="`+flecha_volver+`" alt="">
          </a>
          <img src="{{ asset('/img/logo.png')}}" alt="" style="max-width: 100px;width: 50px">
          </span>
          <button class="navbar-toggler" id="btn_superior_hamburguesa"><span class="navbar-toggler-icon" style="padding-top: 9px;"></span></button>
          
      </header>

      <nav id="bottom_nav">
          <a href="{{asset('/clientes')}}" class="nav-item">
              <img src="{{asset('/img/customer.svg')}}"> Clientes
          </a>
          <a href="{{asset('/turnos')}}" class="nav-item">
              <img src="{{asset('/img/sport.svg')}}"> Turnos
          </a>
          <a href="{{asset('/cobranzas')}}" class="nav-item active">
              <img src="{{asset('/img/money.svg')}}"> Cobranzas
          </a>
      </nav>

        @section("contenido")
        @show
      
    </main>

    @section("modals")
    @show

    @section("js_code")
    @show

  
  </body>
</html>