<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reportes</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/icons/favicon.png') }}" />

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/reportes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  </head>
  <body>

    <div class="" id="todo">

    <div id="todo">

      <div class="row">
        <div class="col-md-8 col-xs-10">
          <h3>Instituto Tecnológico de Nuevo Casas Grandes</h3>
        </div>
        <div class="col-md-2 col-xs-2 ">

              <img src="{{ asset('img/logotec.png') }}" alt="" style="height: 65px;">

        </div>
        <br>
      </div>
      <div class="row">
        <div class="col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
          <h4>Indicadores de calidad</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-xs-4 col-md-offset-8 col-xs-offset-8">
          <h5 class="fecha color-gray" style="border-bottom: 1px solid black";>Fecha de Elaboración:{{ date('d-M-Y') }}</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-xs-4">
          <h5>Área responsable del Indicador:</h5>
        </div>
        <div class="col-md-8 col-xs-8">
          <h5 style="border-bottom: 1px solid black";>Subdireccion Academica</h5>
        </div>

      </div>
      <div class="row">
        <div class="col-md-4 col-xs-4">
          <h5>Nombre del Indicador:</h5>
        </div>
        <div class="col-md-8 col-xs-8">

          <h5 style="border-bottom: 1px solid black";>asdasdasdas</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-xs-4">
          <h5>Objetivo:</h5>
        </div>
        <div class="col-md-8 col-xs-8">
          <h5 style="border-bottom: 1px solid black";>Evaluar del desempeño  institucional en acciones de atecion compensator que contribuyan a la permanencia de los alumnos</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-xs-3">
          <h4>Valor de la meta:</h4>
        </div>
        <div class="col-md-4 col-xs-4">
          <h5 style="">Tendencia:</h5>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-12">
          <canvas id="myChart1" width="200" height="550"></canvas>
        </div>
      </div>

    </div>
  </body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('js/Chart.bundle.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script type="text/javascript">

<<<<<<< HEAD


=======
>>>>>>> master
    function imprimir(elemento){
      var respaldo = $('body').html();
      var div = $('#'+elemento).clone();
      $('body').empty().html(div);
      window.print();
      $('body').html(respaldo);
    }
    $(document).ready(function(){


      var ctx1 = document.getElementById("myChart1").getContext('2d');
      ctx1.canvas.width = 500;
      var myChart1 = new Chart(ctx1, {
          type: 'line',
          data: {
              labels: [  asdasd  ],
              datasets: [{
                  label: 'Pre-Evaluacion',
                  borderColor : "rgba(151,187,205,1)",
                  data: [ 10  ],
            },
            {
              label :'Post-Evaluacion',
              borderColor : "rgba(151,100,205,1)",
              data : [  20  ]
            }

          ]
          },
          options : {
            elements : {
              rectangle : {
                borderWidth : 1,
                borderColor : "rgb(0,255,0)",
                borderSkipped : 'bottom'
              }
            },
            responsive : true,
            maintainAspectRatio: false,
            title : {
              display : true
            }
          }
      });
      imprimir('todo');
    });

<<<<<<< HEAD

=======
>>>>>>> master
  </script>

</html>
