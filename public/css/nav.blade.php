@if(Auth::user()->privilegios == 'Administrador')

<nav class="navbar-default sidebar leftPane2 col-md-2">
  <img class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1" id="imglogo" alt="ONEAMI Escuela para Padres" src="../img/icons/OneamiLogoWhite.svg">
  <div class="navName">MENU</div>
  <ul class="nav nav-pills nav-stacked">
    <li role="presentation"><a href="{{ url('/administracion/stats') }}"><i class="fas fa-chart-line padRight"></i>Estadísticas</a></li>
    <li role="presentation"><a href="{{ url('/administracion/grupos') }}"><i class="fas fa-users padRight"></i>Grupos</a></li>
    <li role="presentation"><a href="{{ url('/administracion/talleres')}}"><i class="fas fa-book padRight"></i>Talleres</a></li>
    <li role="presentation"><a href="{{ url('/administracion/alumnos') }}"><i class="fas fa-user padRight"></i>Alumnos</a></li>
  </ul>

  <div class="navName">ADMINISTRACIÓN</div>
  <ul class="nav nav-pills nav-stacked">

    <li role="presentation"><a href="{{ url('/administracion/usuarios') }}"><i class="fas fa-user-plus padRight"></i>Usuarios</a></li>
    <li role="presentation"><a href="{{ url('/administracion/metas') }}"><i class="fas fa-calendar-check padRight"></i>Metas</a></li>
    <li role="presentation"><a href="{{ url('/administracion/preguntas') }}"><i class="fas fa-question-circle padRight"></i>Preguntas</a></li>
  </ul>
</nav>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header col-md-4">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">{{ Auth::user()->name }}<span class="caret"></span></a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

@else


<nav class="navbar-default sidebar leftPane2 col-md-2">
  <img class="col-md-4 col-md-offset-4" id="imglogo" alt="ONEAMI Escuela para Padres" src="../img/logotec.png">
  <div class="tec1">
    INSTITUTO TECNOLÓGICO SUPERIOR
  </div>
  <div class="tec2">
    DE NUEVO CASAS GRANDES
  </div>
  <div class="navName">ADMINISTRACIÓN</div>
  <ul class="nav nav-pills nav-stacked">
    <li role="presentation"><a href="{{ url('/administracion/stats') }}"><i class="fas fa-chart-line padRight"></i>Estadísticas</a></li>
    <li role="presentation"><a href="{{ url('/administracion/grupos') }}"><i class="fas fa-users padRight"></i>Grupos</a></li>
    <li role="presentation"><a href="{{ url('/administracion/talleres')}}"><i class="fas fa-book padRight"></i>Talleres</a></li>
    <li role="presentation"><a href="{{ url('/administracion/alumnos') }}"><i class="fas fa-user padRight"></i>Alumnos</a></li>
  </ul>

</nav>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header col-md-4">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">{{ Auth::user()->name }}<span class="caret"></span></a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

@endif
