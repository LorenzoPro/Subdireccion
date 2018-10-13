<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('Titulo')</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/admincss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/yearpicker.css') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya|Raleway|Cabin|Fjalla+One|Oswald|PT+Sans" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  </head>
  <body>
    <div class="col-md-10 col-md-offset-2">
      @yield('contenido')
      @yield('usuarios')
      @yield('carreras')
      @yield('indicadores')

    </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{  asset('js/jquery-3.3.1.min.js')  }}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/yearpicker.js') }}"></script>

        @yield('scripts')
        @yield('script-porcentajes')
        @yield('jQueryUsuarios')
  </body>
</html>
