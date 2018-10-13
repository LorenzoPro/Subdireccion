@if($errors->any())
  <div class="conf alert alert-warning alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if(session()->has('mensaje'))
  <div class="conf alert alert-success alert-dismissible fade in" data-backdrop="static">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
    {{ session()->get('mensaje') }}
  </div>
@endif

@extends('admin.plantilla')
@extends('includes.nav')

@section('contenido')
<div class="row">
  <div class="title" style="text-align: center; ">Indicadores de Calidad</div>
  <div class="subtitle" style="text-align: center"></div>
</div>

  <div class="row">
    <div class="col-md-4">
      <h4 class="seleccionadores">Indicadores</h4>
      <select class="cate form-control" name="id_indicador" id="indicador">
        @forelse($indicadores as $ind)
          <option value="{{$ind->id_indicador}}" data-id="{{ $ind->id_indicador }}" data-id2="{{$ind->id_indicador}}" class="indicador">{{$ind->nombre}}</option>
        @empty
          <option value=""></option>
        @endforelse
      </select>
    </div>
    <div class="col-md-4">
      <h4 class="seleccionadores">Periodo</h4>
      <select class=" form-control" name="periodo" id="periodo">
          <option value="0" data-periodo="0" class="periodo">Enero-Julio</option>
          <option value="1" data-periodo="1" class="periodo">Agosto-Diciembre</option>
      </select>
    </div>
    <div class="col-md-3">
      <h4 class="seleccionadores">Año</h4>
      <input type="text" class="yearpicker"  name="anio"  style="width: 100%;" value="">
    </div>
    <button type="submit" name="btnir" class="btnagregar2 btnir">IR</button>
  </div>



<button type="button" class="btnagregar navbar-right btnCirculo2" data-toggle="modal" data-target=".datos">
    <i class="glyphicon glyphicon-plus"></i>
</button>

<button type="button" class="btnagregar navbar-right btnCirculo" data-toggle="modal" data-target=".usuarios">
    <i class="glyphicon glyphicon-plus"></i>
</button>

  <div class="row">
    <div class="col-md-3">
      <div class="bg-color-green inicio">
        <h4 class="titulo-inicio">Total de alumnos(as) en tutorias</h4>
        <span class="titulo-inicio titulo-number count variable1" id="Thombres">0</span>
      </div>

      <div class="bg-color-blue inicio">
        <h4 class="titulo-inicio">Total de alumnos(as) inscritas(as)</h4>
        <span class="titulo-inicio titulo-number variable2">0</span>
      </div>
    </div>
    <div class="col-md-3 graph">
      <h4 class="titleGraphs">Tutorias</h4>
      <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <div class="col-md-3 graph">
      <h4 class="titleGraphs">Inscritos</h4>
      <canvas id="myChart2" width="400" height="400"></canvas>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 graphbar">
      <h4 class="titleGraphs">Total de Hombres y mujeres</h4>
      <canvas id="myChartbar" width="400" height="300"></canvas>
    </div>
    <div class="col-md-6 graphbar">
      <h4 class="titleGraphs">Total de Hombres y mujeres</h4>
      <canvas id="myChartbar2" width="400" height="300"></canvas>
    </div>
  </div>



<div class="row">
  <div class="col-md-8 graph2">
    <h4 class="titleGraphs">Comportamiento Anual</h4>
    <canvas id="myChartline" width="400" height="150"></canvas>
  </div>
  <div class="col-md-3 graphmeta">
    <h4 class="titleGraphs">Valor de la meta</h4>
      <canvas class="loader1" width="400" height="400" style="margin-left: 10%;"></canvas>
  </div>
</div>
@endsection
<div class="modal fade usuarios" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title txtcenter-sans" id="gridSystemModalLabel">Agregar Meta.</h4>
      </div>
      <div class="modal-body">
        <div class="card-body">

          {{ Form::open (array('url'=>'/administracion/metas','files'=>"true") )}}
          <fieldset>
            <div class="form-group">
              <label for="">Meta</label>
                  {{ Form::text('meta','',array('class'=>'form-control','placeholder'=>'%')  )}}
            </div>
            <div class="form-group">
              <label for="">Tendecia</label>
              {{  Form::select('tendencia',[
              'Mantener' => 'Mantener',
              'Disminuir' => 'Disminuir',
              'Aumentar'=>'Aumentar'],null, ['class'=>'form-control']  )}}
            </div>
            <div class="form-group">
              <label for="">Periodo</label>
              {{  Form::select('periodo',[
              '0' => 'Enero-Julio',
              '1' => 'Agosto-Diciembre'],null, ['class'=>'form-control']  )}}
            </div>
            {{ Form::hidden('id_indicador','1',array('class'=>'form-control','id'=>'id_indicador')  )}}

            <div class="form-group">
                {{ Form::submit('Aceptar',array('class'=>'btn btn-primary','data-toggle'=>'modal','data-target'=>'.datos')  )}}
                <button type="button" class="contestar btn btn-success">Enviar</button>
            </div>
          </fieldset>
          {{ Form::close() }}

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade datos" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title txtcenter-sans" id="gridSystemModalLabel">Ingresa los datos correctamente!.</h4>
      </div>
      <div class="modal-body">
        <div class="card-body">

          @forelse($carreras as $car)

          {{ Form::open (array('url'=>'/administracion/calidad','id'=>"Formdatos". $car->id_carrera) )}}
            <input type="text" name="id_carrera" class="id_carrera" value="{{$car->id_carrera}}">

            <div class="from-group">
                <input type="text" name="id_indicador" class="id_indicador" value="1"><br>
              <label for="">{{$car->nombre}}</label><br>
              hombres
              <input type="text" name="hombres" value=""><br>
              mujeres
              <input type="text" name="mujeres" value=""><br>
              hombres2
              <input type="text" name="hombres2" value=""><br>
              mujeres2
              <input type="text" name="mujeres2" value=""><br>
            </div>
            <button type="button" class="contestar btn btn-success">Enviar</button>

          {{ Form::close() }}

          @empty
            <p>Sin registros</p>
          @endforelse

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@section('scripts')

  <script src="{{ asset('js/Chart.bundle.min.js') }}" type="text/javascript"></script>
  <script>

  $(document).ready(function(){
    var id=1;
    var periodo=0;
    var anio=1;
    $(".indicador").on("click", function(){
       id = $(this).data('id');
       periodo=periodo




      var id2 = $(this).data('id2');
      $("#id_indicador").val(id);
      $(".id_indicador").val(id2);





    });
    $(".periodo").on("click", function(){
      var id2 = id;
      periodo = $(this).data('periodo');

      console.log(id);


    });
    $(".btnir").on("click",function(){
      //console.log(id,periodo);
      periodo=periodo;
      id=id;
      recargar();
      nombre();
      $('.subtitle').fadeOut(1);
      $('.subtitle').fadeIn(1000);

    });
    function recargar(){

      $.ajax({
        url:'/administracion/calidad/Graficas/'+id+"/"+periodo,
        method:'get',

      }).done(function(res){
        $('.variable1').empty();
        $('.variable2').empty();

        var arr=JSON.parse(res);
        var hombres=arr[0];
        var mujeres=arr[1];
        var totalv1=arr[2];
        var hombres2=arr[3];
        var mujeres2=arr[4];
        var totalv2=arr[5];
        var h=hombres[0].suma;
        var h2=hombres2[0].suma2;
        var m=mujeres[0].suma;
        var m2=mujeres2[0].suma2;
        var tv1=totalv1[0].totalV1;
        var tv2=totalv2[0].totalV2;

        console.log(res);
        $('.variable1').append(tv1);
          if (h==null) {
            $('.variable1').append(0);
          }
        $('.variable2').append(tv2);
          if (h2==null) {
            $('.variable2').append(0);
          }
////////////////////////////////////////////////////////////////////////////////
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Mujeres", "Hombres"],
                datasets: [{
                    label: '# of Votes',
                    data: [m, h],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
///////////////////////////////////////////////////////////////////////////////
        var ctx2 = document.getElementById("myChart2");
        var myChart2 = new Chart(ctx2, {
          type: 'doughnut',
          data: {
            labels: ["Mujeres", "Hombres"],
            datasets: [{
              label: '# of Votes',
              data: [m2, h2],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero:true
                }
              }]
            }
          }
        });

      });
    }
    //////////////////////////////////////////FUNCION PARA EL NOMBRE QUE PROBABLEMENTE SE QUITE///////////////
    function nombre(){
      $.ajax({
        url:'/administracion/calidad/nombre/'+id,
        method:'get',

      }).done(function(res){
        $('.subtitle').empty();
        var arr=JSON.parse(res);
        var n=arr[0].nombre;
        console.log(n);
        $('.subtitle').append(n);

      });
    }

    $('.contestar').on("click",function(){

      var form = $(this).parent('form');
      $.ajax({
        url:$(this).parent('form').attr('action'),
        method:'POST',
        data:$(this).parent('form').serialize()
      }).done(function(res){
        console.log(res);
        var x = parseInt(res);
        if(x==1){
          form.fadeOut(200);
        }
      });
      });
  });


  var ctxline = document.getElementById("myChartline");
  var myChartline = new Chart(ctxline, {
      type: 'line',
      data: {
        labels: ["2012", "2013", "2014", "2015", "2016", "2017"],
        datasets: [{
            label: "My First dataset",
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5,20,3, 45],
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
  var ctxlbar2 = document.getElementById("myChartbar2");
  var myChartbar2 = new Chart(ctxlbar2, {
      type: 'bar',
      data: {
        labels: ["CP", "IGEM", "ISC", "II", "Electromecanica", "Electronica"],
        datasets: [{
            label: "Hombres",
            borderColor: 'rgb(255, 99, 132)',
            data: [5, 10, 5,20,3, 45],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
        },
        {
          label: "Mujeres",
          borderColor: 'rgb(255, 99, 132)',
          data: [3,8, 7,15,7, 20],
          backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)'
          ],
        }

      ]
    },
    options: {
     elements: {
         line: {
             tension: 0, // disables bezier curves
         }
     }
 }
  });
  var ctxlbar = document.getElementById("myChartbar");
  var myChartbar = new Chart(ctxlbar, {
      type: 'bar',
      data: {
        labels: ["CP", "IGEM", "ISC", "II", "Electromecanica", "Electronica"],
        datasets: [{
            label: "Hombres",
            borderColor: 'rgb(255, 99, 132)',
            data: [5, 10, 5,20,3, 45],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
        },
        {
          label: "Mujeres",
          borderColor: 'rgb(255, 99, 132)',
          data: [3,8, 7,15,7, 20],
          backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 99, 132, 1)'
          ],
        }

      ]
    },
    options: {
     elements: {
         line: {
             tension: 0, // disables bezier curves
         }
     }
 }
  });
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["hombres", "Mujeres"],
        datasets: [{
            label: '# of Votes',
            data: [0, 0],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
var ctx2 = document.getElementById("myChart2");
var myChart2 = new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: ["Mujeres", "Hombres"],
    datasets: [{
      label: '# of Votes',
      data: [0, 0],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero:true
        }
      }]
    }
  }
});



var ctx3 = document.getElementById("myChart3");
var myChart3 = new Chart(ctx3, {
    type: 'doughnut',
    data: {
        labels: ["Mujeres", "Hombres"],
        datasets: [{
            label: '# of Votes',
            data: [2, 19],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
var ctx4 = document.getElementById("myChart4");
var myChart4 = new Chart(ctx4, {
    type: 'doughnut',
    data: {
        labels: ["Mujeres", "Hombres"],
        datasets: [{
            label: '# of Votes',
            data: [4, 1],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script>
@endsection
@section('script-porcentajes')
<script src="{{ asset('js/jquery.classyloader.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function (){
    console.log('sijaal');
  });

$('.loader1').ClassyLoader({
    percentage: 100,
    speed: 20,
    fontFamily: 'Georgia',
    fontColor: 'rgba(0,0,0,0.4)',
    lineColor: 'rgba(0,255,0,0.8)',
    lineWidth: 3,
    remainingLineColor: 'rgba(0,0,0,0.1)'
});
</script>
@endsection
