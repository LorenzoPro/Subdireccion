<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('Titulo')</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/admincss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="col-md-10 col-md-offset-2">
      @yield('contenido')
      @yield('usuarios')
      @yield('carreras')

    </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{  asset('js/jquery-3.3.1.min.js')  }}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        @yield('scripts')
        @yield('script-porcentajes')
        @yield('jQueryUsuarios')
  </body>
</html>
