<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/icons/favicon.png') }}" />

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/reportes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">



    <style>

        div.itsncg{
          float: left;
          font-weight: bold;
          border-bottom: 2px solid #512f80;
        }
        div.logo{
          float: right;
        }

        div.contenedor{
          width: 100%;
          border: 1px solid #000;
          font-weight: bold;
        }
        div.con{
          width: 100%;
          border: 1px solid #000;
          font-size: 11px;

        }
        div.contenedor2{
          width: 80%;
          float: left;
        }
        div.contenedor3{
          width: 20%;
          float: inline-end;
          padding-left: 3%;

        }
        div.titutlo{
          text-align: center;
          font-size: 20px;
          margin: 2px;
        }
        div.subtitulo{
          float: left;
        }
        div.res{
          text-align: center;
          border-bottom: 1px solid black;

        }
        div.fecha{
          float: right;
          border-bottom: 1px solid black;

        }

        div.valores{
          border: 1px solid #000;
        }
        div.variable1{
          width: 10%;
          text-align: right;
          float: left;
          position: absolute;
          font-size: 10px;
          padding: 5px;
        }
        div.tendencia{
          margin-left: 25%;
        }
        div.contenido{
          width: 65%;
          margin-left: 15%;
          border-bottom: 1px solid black;
          text-align: center;
          font-size: 10px;
          padding: 5px;
        }
        div.valor{
          width: 20%;
          border-bottom: 1px solid black;
          text-align: center;
          font-size: 10px;
          padding: 5px;
        }
        div.valor2{
          width: 20%;
          border-bottom: 1px solid black;
          text-align: center;
          font-size: 10px;
          padding: 5px;
          float: left;
        }
        div.valortotal{
          position: absolute;
          padding-left: 50px;
        }
        h6.dd{
          float: left;
        }
        h6.v{
          padding-left: 87%;
        }
        div.firmas{
          width: 30%;
          text-align: center;
          border-top: 1px solid black;
          float: left;
          margin-top: 30px;
          font-size: 11px
        }
        div.er{
          width: 100%;
          text-align: center;
          font-size: 11px
        }
        div.firmas2{
          width: 30%;
          text-align: center;
          border-top: 1px solid black;
          float: right;
          margin-top: 30px;
          font-size: 11px
        }
        div.er2{
          width: 100%;
          text-align: center;
          font-size: 11px;
        }


        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        #customers td{
          font-size: 10px;
        }
        #customers2 td{
          font-size: 10px;
        }
        #customers td, #customers th {
            border: 1px solid #ddd;
            text-align: center;

        }
        #customers2 {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 20%;
            margin: 20px;

        }
        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 20px;
            text-align: center;
            color: black;
        }
       td#total{
          padding-top: 20px;
        }
        #customers2 td, #customers2 th {
            border: 1px solid #ddd;
            text-align: center;
        }

        #customers2 tr:nth-child(even){background-color: #f2f2f2;}

        #customers2 tr:hover {background-color: #ddd;}

        #customers2 th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;

            color: black;
        }

        div.grafica{
          width: 40%;
          height: 350px;
          float: left;
        }
    </style>
  </head>
  <body>




       <div class="itsncg">
        INSTITUTO TECNOLÓGICO SUPERIOR DE NUEVO CASAS GRANDES
      </div >
      <div style="border-bottom: 2px solid #f7dc6f;    width: 463px;     padding-top: 17px;">

      </div>
      <div class="logo">
        <img src="{{ asset('img/logotec.png') }}" alt="" style="height: 65px;">
      </div>
      <br>
      <div class="titutlo">
          Indicadores de calidad
      </div>
      <div class="fecha">
          Fecha:{{ date('d-M-Y') }}
      </div><br>

      <div class="subtitulo">
          Área responsable del Indicador:
      </div>
      <div class="res">
        {{str_replace('"', ' ', $area)}}
      </div>
      <div class="subtitulo">
          Nombre del Indicador:
      </div>
      <div class="res">
        {{str_replace('"', ' ', $nombres)}}
      </div>

      <div class="subtitulo">
        Objetivo:
      </div>
      <div class="res">
        {{str_replace('"', ' ', $objetivo)}}
      </div>

      <div class="meta subtitulo">
          Valor de la meta:{{str_replace('"', ' ', $meta)}}%
      </div>
      <div class="tendencia" style="padding-left:15%;">
          Tendencia:{{str_replace('"', ' ', $tendencia)}}
      </div>

      <div class="periodo contenedor">
        PERIODO CORRESPONDIENTE:
      </div>
      <div class="con">
        <table id="customers" style="border: 1px solid #000;">
          <thead>
            <tr>
              <th>Desglose Variable 1</th>
              <th>H</th>
              <th>M</th>
              <th>Desglose Variable 2</th>
              <th>H</th>
              <th>M</th>
              <th>Total desgose</th>

            </tr>
          </thead>
          <tbody>
              @forelse($carreras as $car)
            <tr>
              <td >{{ $car->nombres }}</td>
              <td>{{ $car->hombres }}</td>
              <td>{{ $car->mujeres }}</td>
              <td >{{ $car->nombres }}</td>
              <td>{{ $car->hombres2 }}</td>
              <td>{{ $car->mujeres2 }}</td>
              <td>{{ $car->desglose }}%</td>

            </tr>

            @empty
              <p>Sin Registros</p>
            @endforelse

            <tr>
              <td id="total">Total</td>
              <td id="total">{{str_replace('"', ' ', $hombres)}}</td>
              <td id="total">{{str_replace('"', ' ', $mujeres)}}</td>
              <td id="total">Total</td>
              <td id="total">{{str_replace('"', ' ', $hombres2)}}</td>
              <td id="total">{{str_replace('"', ' ', $mujeres2)}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <br>
      <div class="valores contenedor">
        DESCRIPCIÓN Y DATOS:
      </div>
        <div  style="border: 1px solid #000; height: 60px; width: 80%; float:left;">
          <div  style=" width:20%; height:50%; float:left; text-align:right; padding-top:10px;">
            Variable 1=
          </div>
          <div  style=" width:80%; height:50%; border-bottom: 1px solid #000; text-align:center; float:left; padding-top:10px;">
            {{str_replace('"', ' ', $variable1)}}
          </div>
          <div  style=" width:20%; height:50%; float:left; text-align:right;">
            Variable 2=
          </div>
          <div  style=" width:80%; height:50%; text-align:center; float:left;">
            {{str_replace('"', ' ', $variable2)}}
          </div>
        </div>
        <div  style="border: 1px solid #000; height: 60px; width: 20%; float:left;">
          <div style="width:40%; float:left;">
            <div style="border-bottom: 1px solid #000; height:50%; text-align:center; padding-top:10px;">
              {{str_replace('"', ' ', $TotalVariable1)}}
            </div>
            <div style="text-align:center;">
              {{str_replace('"', ' ', $TotalVariable2)}}
            </div>

          </div>
          <div style="width:60%; float:left; padding-top: 19px;">
            <div>
                ={{str_replace('"', ' ', $porcentajeFinal1)}}%
            </div>
          </div>
        </div>
        <br>
        <br>
        <br>
        <br>

      <div class="contenedor">
        COMPORTAMIENTO HISTORICO DEL INDICADOR:
      </div>
      <div  style="border: 1px solid #000; height: 180px;">
        <div class="row">

          <div style="width:180px; float:left;">

            <table id="customers2">
              <thead>
                <tr>
                  <th>Historial</th>
                  <th>ENE-JUL %</th>
                  <th>AGO-DIC %</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{str_replace('"', ' ', $anio5)}}</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinal5)}}%</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinaldic5)}}%</td>
                </tr>
                <tr>
                  <td>{{str_replace('"', ' ', $anio4)}}</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinal4)}}%</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinaldic4)}}%</td>
                </tr>
                <tr>
                  <td>{{str_replace('"', ' ', $anio3)}}</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinal3)}}%</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinaldic3)}}%</td>
                </tr>
                <tr>
                  <td>{{str_replace('"', ' ', $anio2)}}</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinal2)}}%</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinaldic2)}}%</td>
                </tr>
                <tr>
                  <td>{{str_replace('"', ' ', $anio)}}</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinal1)}}%</td>
                  <td>{{str_replace('"', ' ', $porcentajeFinaldic1)}}%</td>
                </tr>
              </tbody>
            </table>

          </div>
           <div style="height:200px; width:400px;float:left;margin-left:100px; padding-top:25px;">
              <canvas id="myChartline" width="350" height="100"></canvas>
          </div>
        </div>
      </div>
      <br>


       <div class="contenedor">
        ESTRATEGIAS PARA EL CUMPLIMIENTO DE METAS:
      </div>
      <div class="estrategias" style="border: 1px solid #000; height:100px;">

      </div>
      <div class=" contenedor">
        OBSERVACIONES:
      </div>
      <div class="observaciones" style="border: 1px solid #000; height:50px;">

      </div>



     <br>
      <div class="firmas">
        Responsable del Indicador
        <div class="er1">
          Entrada
        </div>
      </div>
      <div class="firmas2">
        Evaluación Institucional y Estadística
        <div class="er2">
          Recibe
        </div>
      </div>












  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="{{  asset('js/jquery-3.3.1.min.js')  }}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->

  <script src="{{ asset('js/Chart.bundle.min.js') }}" type="text/javascript"></script>

  <script type="text/javascript">

  $(document).ready( function(){

    var estra = {!!$estrategias!!}
    var e = estra[0];
    var es = e.estrategias;
    $('.estrategias').empty();
    $('.estrategias').append(es);
    var obser = {!!$observaciones!!}
    var ob = obser[0];
    var o = ob.observaciones;
    $('.observaciones').empty();
    $('.observaciones').append(o);
    console.log(0);
    var ctxline = document.getElementById("myChartline");
    var myChartline = new Chart(ctxline, {
        type: 'line',
        data: {
          labels: [{!!$anio5!!},{!!$anio4!!},{!!$anio3!!},{!!$anio2!!},{!!$anio!!}],
          datasets: [{
              label: "Ene-Jul %  ",
              borderColor: 'rgb(255, 99, 244)',
              data: [{!!$porcentajeFinal5!!},{!!$porcentajeFinal4!!},{!!$porcentajeFinal3!!},{!!$porcentajeFinal2!!},{!!$porcentajeFinal1!!}],
          },{
              label: "Ago-Dic %  ",
              borderColor: "#3cba9f",
              data: [{!!$porcentajeFinaldic5!!},{!!$porcentajeFinaldic4!!},{!!$porcentajeFinaldic3!!},{!!$porcentajeFinaldic2!!},{!!$porcentajeFinaldic1!!}],
          }]
      },
      options: {
       elements: {
           line: {
               tension: 0, // disables bezier curves
           }
       }
   }
    });
  });

  </script>

    </body>


</html>
