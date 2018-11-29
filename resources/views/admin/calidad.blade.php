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
  <div class="title" style="text-align: center; ">Indicadores de las divisiones academicas</div>
  <div class="subtitle" style="text-align: center"></div>
</div>

  <div class="row">
    <div class="col-md-4">
      <h4 class="seleccionadores">Indicadores</h4>
      <select class="cate form-control" name="id_indicador" id="indicador">
        <option value="" disabled selected>--Seleciona el Indicador--</option>
        @forelse($asignaciones as $ind)
          <option value="{{$ind->id_indicador}}" data-id="{{ $ind->id_indicador }}" data-id2="{{$ind->id_indicador}}" class="indicador">{{$ind->nombre}}</option>
        @empty
          <option value=""></option>
        @endforelse
      </select>
    </div>
    <div class="col-md-4">
      <h4 class="seleccionadores">Periodo</h4>
      <select class=" form-control" name="periodo" id="periodo">
          <option value="3" disabled selected>--Seleciona el periodo--</option>
          <option value="0" data-periodo="0" class="periodo">Enero-Julio</option>
          <option value="1" data-periodo="1" class="periodo">Agosto-Diciembre</option>
      </select>
    </div>
    <div class="col-md-3">
      <h4 class="seleccionadores">Año</h4>
      <input type="text"  name="anio" style="width: 100%;" value="">
    </div>

    <button type="submit" name="btnir" class="btnagregar2 btnir"><i class="fas fa-check"></i></button>
  </div>



<button type="hidden" id="btndatos" class="btnagregar btn btn-success navbar-right btnCirculo2" data-toggle="modal" data-target=".datos">
  <i class="fas fa-plus"></i>
</button>

<button type="button" id="btnmeta" class="btnagregar navbar-right btnCirculo" data-toggle="modal" data-target=".usuarios">
    <i class="far fa-calendar-plus"></i>
</button>

  <div class="row">
    <div class="col-md-3">
      <div class="bg-color-red inicio">
        <h4 class="titulo-inicio" id="variable1">Total de alumnos(as) en tutorias</h4>
        <span class="titulo-inicio titulo-number count variable1" id="Thombres">0</span>
      </div>

      <div class="bg-color-blue inicio">
        <h4 class="titulo-inicio" id="variable2">Total de alumnos(as) inscritas(as)</h4>
        <span class="titulo-inicio titulo-number variable2">0</span>
      </div>
    </div>
    <div class="col-md-3 graph myChart">
      <h4 class="titleGraphs titg">Tutorias</h4>
      <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <div class="col-md-3 graph myChart2">
      <h4 class="titleGraphs titg2" >Inscritos</h4>
      <canvas id="myChart2" width="400" height="400"></canvas>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6 graphbar myChartbar">
      <h4 class="titleGraphs">Total de Hombres y mujeres</h4>
      <canvas id="myChartbar" width="400" height="300"></canvas>
    </div>
    <div class="col-md-6 graphbar myChartbar2">
      <h4 class="titleGraphs">Total de Hombres y mujeres</h4>
      <canvas id="myChartbar2" width="400" height="300"></canvas>
    </div>
  </div>


<div class="row">
  <div class="col-md-8 graph2 myChartline">
    <h4 class="titleGraphs">Comportamiento Anual</h4>
    <canvas id="myChartline" width="400" height="150"></canvas>
  </div>
  <div class="col-md-3 graphmeta">
    <h4 class="titleGraphs">Valor de la meta</h4>
      <canvas class="loader1" width="400" height="400" style="margin-left: 10%;"></canvas>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4">
    <button type="submit" name="button" class="btn btn-success estra" style="width: 100%; margin:3px;" ><i class="fas fa-plus"></i>&nbsp;Agregar Estrategias</button>
    <button type="submit" name="button" class="btn btn-danger eliminar" style="width: 100%; margin:3px;" ><i class="fas fa-trash-alt"></i>&nbsp;Eliminar Indicador</button>
    <button type="submit" name="button" class="btn btn-info reportes" style="width: 100%; margin:3px;" ><i class="fas fa-print"></i>&nbsp;Imprimir Reporte</button>
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

            <div class="form-group">
              <label for="">Meta</label>
                  <input type="text" name="meta" class="form-control" value=""><br>

              <label for="">Tendecia</label>
              <select class="form-control" name="tendencia">
                <option value="Disminuir">Disminuir</option>
                <option value="Mantener">Mantener</option>
                <option value="Aumentar">Aumentar</option>
              </select>



              <input type="hidden" name="periodo" class="periodos" value="0 "><br>
              <input type="hidden" name="id_indicador" class="id_indicador" value="1"><br>




            </div>
            <button type="button" name="button" class="btnMetas btn btn-success" data-toggle="modal" data-target=".datos" data-dismiss="modal">Enviar</button>

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
            <input type="hidden" name="id_carrera" class="id_carrera" value="{{$car->id_carrera}}">

            <div class="from-group">
                <input type="hidden" name="id_indicador" class="id_indicador" value="1"><br>
                <input type="hidden" name="periodo" class="periodo" id="periodotext" value="0"><br>
              <h3 for="">{{$car->nombre}}</h3><br>
              <h5 for="" style="text-align: center;">Variable 1</h5>
              Hombres
              <input type="text" name="hombres" class="form-control" value=""><br>
              Mujeres
              <input type="text" name="mujeres" class="form-control" value=""><br>
              <h5 for="" style="text-align: center;">Variable 2</h5>
              Hombres
              <input type="text" name="hombres2" class="form-control" value=""><br>
              Mujeres
              <input type="text" name="mujeres2" class="form-control" value=""><br>
            </div>
            <button type="button" class="contestar btn btn-success">Enviar</button>

          {{ Form::close() }}

          @empty
            <p>Sin registros</p>
          @endforelse

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btnlisto" data-dismiss="modal">Listo</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@section('scripts')


  <script src="{{ asset('js/Chart.bundle.min.js') }}" type="text/javascript"></script>
  <script>

  $(document).ready(function(){
    var currentTime = new Date();
    var year = currentTime.getFullYear();
    var id=1;
    var periodo=3;
    var anio = year;
    var x=0;

    $('.reportes').fadeOut(1);
    $('.eliminar').fadeOut(1);
    $('.estra').fadeOut(1);
    $("#btnmeta").fadeOut(.1);
    $("#btndatos").fadeOut(.1);
    $('.subtitle').append("Selecciona el Indicador");



    console.log(id);
    $.ajax({
      url:'/administracion/calidad/index/'+id+"/"+periodo+"/"+anio,
      method:'get',
    }).done(function(res){

    });
    $(".btnmetas").on("click", function(){
      x=1;
    });
    $(".btnlisto").on("click", function(){

window.location.href = "administracion/calidad";
    });

    $(".indicador").on("click", function(){
      id = $(this).data('id');
      periodo=periodo;
      console.log(id);
      var id2 = $(this).data('id2');
      $("#id_indicador").val(id);
      $(".id_indicador").val(id2);
    });

    $(".periodo").on("click", function(){
      var id2 = id;
      periodo = $(this).data('periodo');
      console.log(periodo);
      //$(".periodo").val(periodo);
      $(".periodos").val(periodo);
    });
    $('.anio').keyup(function(){
      var currentTime = new Date();
      anio=$(this).val();
      var year = currentTime.getFullYear();
      console.log(year);
      if (year>anio) {
        $("#btnmeta").fadeOut(.1);
      }

    });
    $(".btnir").on("click",function(){
      //console.log(id,periodo);
      periodo=periodo;
      id=id;
      anio=anio;

      console.log(anio);



      recargar();
      nombre();
      carreras();
      periodos();
      verificar();

      $('.subtitle').fadeOut(1);
      $('.subtitle').fadeIn(1000);
      $('.reportes').fadeIn(1000);
      $('.eliminar').fadeIn(1000);
      $('.estra').fadeIn(1000);

    });
    $(".reportes").on("click", function(){
      periodo=periodo;
      id=id;
      anio=anio;
      console.log(periodo);
      console.log(id);
      console.log(anio);
      reporte();
    });
    $(".eliminar").on("click", function(){
      periodo=periodo;
      id=id;
      anio=anio;
      console.log('jalo');
      elimina();
    });

    function reporte(){
      $('body').load('administracion/reportes/index/'+id+"/"+periodo+"/"+anio, function(e){
        console.error(e);
        //window.print();
        setTimeout(function() {
          window.print();
          setTimeout(function() {

window.location.href = "administracion/calidad";
          },1000);
        },500);


      });


  /*  $.ajax({
        url:'administracion/reportes/index/'+id+"/"+periodo+"/"+anio,
        method:'get',
      }).done(function(res){
        console.log(res);
      });*/
    }
    function elimina(){
      $.ajax({
        url:'/administracion/calidad/eliminar/'+id+"/"+periodo+"/"+anio,
        method:'get',
      }).done(function(res){
        console.log(res);
        location.reload();
      });
    }
    function verificar(){
      $.ajax({
        url:'/administracion/calidad/ajax2/'+id+"/"+periodo+"/"+anio,
        method:'get',
      }).done(function(res){
        console.log(res);
        var x = parseInt(res);
        if (x==1) {
          $("#btnmeta").fadeIn(1);

        }else {
          $("#btnmeta").fadeOut(1000);
        }
      });
    }
    function recargar(){
      $.ajax({
        url:'/administracion/calidad/Graficas/'+id+"/"+periodo+"/"+anio,
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
        //console.log(res);

        $('.variable1').append(tv1);
          if (h==null) {
            $('.variable1').append(0);
          }
        $('.variable2').append(tv2);
          if (h2==null) {
            $('.variable2').append(0);
          }
////////////////////////////////////////////////////////////////////////////////
        $("canvas#myChart").remove();
        $("div.myChart").append('<canvas id="myChart" width="400" height="400"></canvas>');
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
        $("canvas#myChart2").remove();
        $("div.myChart2").append('<canvas id="myChart2" width="400" height="400"></canvas>');
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
    }//llave de funcion recargar
    var arrayCarreras=[];
    var arrayHombres=[];
    var arrayMujeres=[];
    var arrayHombres2=[];
    var arrayMujeres2=[];
    function carreras(){
      $.ajax({
        url:'/administracion/calidad/carreras/'+id+"/"+periodo+"/"+anio,
        method:'get',

      }).done(function(res){
        arrayCarreras=[];
        arrayHombres=[];
        arrayMujeres=[];
        arrayHombres2=[];
        arrayMujeres2=[];



        res=res.replace(/\\/g,"");
        res=res.replace(/"/gi,"");
        //console.log("RES: "+res);
        var arr=res.split("#");
        var arr2=arr[0].split(",");
        var arr3=arr[1].split(",");
        var arr4=arr[2].split(",");
        var arr5=arr[3].split(",");
        var arr6=arr[4].split(",");
        //console.log(arr);
        for(var x=0;x<arr2.length-1;x++){
          arrayCarreras.push(arr2[x].trim());
        }
        for(var x=0;x<arr3.length-1;x++){
          arrayHombres.push(arr3[x].trim());
        }
        for(var x=0;x<arr4.length-1;x++){
          arrayMujeres.push(arr4[x].trim());
        }
        for(var x=0;x<arr5.length-1;x++){
          arrayHombres2.push(arr5[x].trim());
        }
        for(var x=0;x<arr6.length-1;x++){
          arrayMujeres2.push(arr6[x].trim());
        }
        var nombres=arr2[0];
        var nombres2=arr2[1];
        var nombres3=arr2[2];
        var hombres1=arr2[4];
        var hombres2=arr2[5];
        var hombres3=arr2[6];

      //  console.log(nombres2);

        $("canvas#myChartbar").remove();
        $("div.myChartbar").append('<canvas id="myChartbar" width="400" height="300"></canvas>');
        var ctxlbar = document.getElementById("myChartbar");
        var myChartbar = new Chart(ctxlbar, {
            type: 'bar',
            data: {
              labels: arrayCarreras,
              datasets: [{
                  label: "Hombres",
                  borderColor: 'rgb(54, 162, 235)',
                  data: arrayHombres,
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
                data: arrayMujeres,
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

        $("canvas#myChartbar2").remove();
        $("div.myChartbar2").append('<canvas id="myChartbar2" width="400" height="300"></canvas>');
        var ctxlbar2 = document.getElementById("myChartbar2");
        var myChartbar2 = new Chart(ctxlbar2, {
            type: 'bar',
            data: {
              labels: arrayCarreras,
              datasets: [{
                  label: "Hombres",
                  borderColor: 'rgb(54, 162, 235)',
                  data: arrayHombres2,
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
                data: arrayMujeres2,
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
      });
    }//llave de funcion carreras
    function periodos(){
      $.ajax({
        url:'/administracion/calidad/porcentaje/'+id+"/"+periodo+"/"+anio,
        method:'get',
      }).done(function(res){
        var arr =JSON.parse(res);
        var porciento= arr[0];
        var p = porciento[0].Porcentaje;
        var porciento2= arr[1];
        var p2 = porciento2[0].Porcentaje;
        var porciento3= arr[2];
        var p3 = porciento3[0].Porcentaje;
        var porciento4= arr[3];
        var p4 = porciento4[0].Porcentaje;
        var porciento5= arr[4];
        var p5 = porciento5[0].Porcentaje;
        var anio1=arr[5];
        var anio2=arr[6];
        var anio3=arr[7];
        var anio4=arr[8];
        var anio5=arr[9];

        if (p2==null) {
          p2=0;
          p3=0;
          p4=0;
          p5=0;
        }
        if (p==null) {
          $('.reportes').fadeOut(1);
          $('.eliminar').fadeOut(1);
          $('.estra').fadeOut(1);
        }

          console.log(anio1);
          $("canvas#myChartline").remove();
          $("div.myChartline").append('<canvas id="myChartline" width="400" height="150"></canvas>');
          var ctxline = document.getElementById("myChartline");
          var myChartline = new Chart(ctxline, {
              type: 'line',
              data: {
                labels: [anio5,anio4,anio3,anio2,anio1],
                datasets: [{
                    label: "Porcentaje  ",
                    borderColor: 'rgb(255, 99, 244)',
                    data: [p5,p4,p3,p2,p],
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


          console.log(p);
          /////////////////////////////////grafica de porcentaje
          $('.loader1').ClassyLoader({
              percentage: p,
              speed: 20,
              fontFamily: 'Georgia',
              fontColor: 'rgba(0,0,0,0.4)',
              lineColor: 'rgba(0,255,0,0.8)',
              lineWidth: 3,
              remainingLineColor: 'rgba(0,0,0,0.1)'
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
        $('#variable1').empty();
        $('#variable2').empty();
        $('.titg').empty();
        $('.titg2').empty();
        var arr=JSON.parse(res);
        var nombres=arr[0];
        var variable1=arr[1];
        var variable2=arr[1];
        var n=nombres[0].nombre;
        var v=variable1[0].variable1;
        var v2=variable2[0].variable2;
        console.log(n);
        $('.subtitle').append(n);
        $('#variable1').append(v);
        $('#variable2').append(v2);
        $('.titg').append(v);
        $('.titg2').append(v2);

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

      $('.btnMetas').on("click",function(){

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

  /////////////////////////////////grafica de porcentaje
  $('.loader1').ClassyLoader({
      percentage: 1,
      speed: 20,
      fontFamily: 'Georgia',
      fontColor: 'rgba(0,0,0,0.4)',
      lineColor: 'rgba(0,255,0,0.8)',
      lineWidth: 3,
      remainingLineColor: 'rgba(0,0,0,0.1)'
  });


</script>
@endsection
