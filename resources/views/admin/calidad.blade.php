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
  <div class="title" style="text-align: center; padding-top:80px;">Indicadores de Calidad</div>
  <div class="subtitle" style="text-align: center">Alumnos y alumnas en tutorias.</div>
</div>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <label>Seleccionar Indicador</label><br>
    <select class="cate form-control" name="id_categoria" id="indicador">
      @forelse($indicadores as $ind)
        <option value="{{$ind->id_indicador}}" data-id="{{ $ind->id_indicador }}" class="indicador">{{$ind->nombre}}</option>
      @empty
        <option value=""></option>
      @endforelse
    </select>
  </div>
</div>

<button type="button" class="btnagregar navbar-right btnCirculo" data-toggle="modal" data-target=".usuarios">
    <i class="glyphicon glyphicon-plus"></i>
</button>

  <div class="row">
    <div class="col-md-3">
      <div class="bg-color-green inicio">
        <h4 class="titulo-inicio">Total de alumnos(as) en tutorias</h4>
        <span class="titulo-inicio titulo-number count">943</span>
      </div>

      <div class="bg-color-blue inicio">
        <h4 class="titulo-inicio">Total de alumnos(as) inscritas(as)</h4>
        <span class="titulo-inicio titulo-number count">262</span>
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
              'Enero-Julio' => 'Enero-Julio',
              'Agosto-Diciembre' => 'Agosto-Diciembre'],null, ['class'=>'form-control']  )}}
            </div>
            {{ Form::hidden('id_indicador','1',array('class'=>'form-control','id'=>'id_indicador')  )}}

            <div class="form-group">
                {{ Form::submit('Aceptar',array('class'=>'btn btn-primary','data-toggle'=>'modal','data-target'=>'.datos')  )}}
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

          {{ Form::open (array('url'=>'/administracion/carreras','files'=>"true") )}}
          <fieldset>
            <div class="form-group">
              <label for="">Nombre</label>
                  {{ Form::text('nombre','',array('class'=>'form-control','placeholder'=>'Nombre')  )}}
            </div>
            <div class="form-group">
                {{ Form::submit('Aceptar',array('class'=>'btn btn-primary')  )}}
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

@section('scripts')

  <script src="{{ asset('js/Chart.bundle.min.js') }}" type="text/javascript"></script>
  <script>

  $(document).ready(function(){
    $(".indicador").on("click", function(){
      var id = $(this).data('id');

      //var em=$(this).data('email');
      $("#id_indicador").val(id);

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
            data: [12, 19],
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
        labels: ["hombres", "Mujeres"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19],
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
