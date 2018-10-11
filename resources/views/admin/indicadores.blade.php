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

@section('Titulo')
{{ $titulo }}
@endsection

@section('indicadores')
<div class="row">
  <div class="title" style="text-align: center; padding-top:110px;">Indicadores</div>
  <div class="subtitle" style="text-align: center">Consulta, agrega y elimina.</div>
</div>
<button type="button" class="btnagregar navbar-right btnCirculo" data-toggle="modal" data-target=".usuarios">
    <i class="glyphicon glyphicon-plus"></i>
</button>
<div class="row">
  <div class="table col-md-10 col-sm-10 col-lg-10" style="padding-left:80px; padding-right:80px;">
    <table class="table table-striped">
      <tbody>
        <tr>
          <th>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>NOMBRE</th>
                  <th>AREA</th>
                  <th>OBJETIVO</th>
                  <th>EDITAR</th>
                  <th>ELIMINAR</th>
                </tr>
              </thead>
              <tbody>
                @forelse($indicadores as $ind)
                  <tr>

                    <th >{{ $ind->nombre }}</th>
                    <th>{{ $ind->area }}</th>
                    <th>{{ $ind->objetivo }}</th>
                    <th>
                      <button type="button" name="btneditar" data-toggle="modal" data-target=".editar" class="btn btnedit"
                      data-id="{{ $ind->id_indicador }}"
                      data-nombre="{{  $ind->nombre  }}"
                      data-area="{{  $ind->area  }}"
                      data-objetivo="{{  $ind->objetivo  }}"
                      >
                        <i class="glyphicon glyphicon-pencil"></i>
                      </button>
                    </th>
                    <th>
                        <button class="btn" type="button"  data-toggle="modal" data-target=".eliminar{{ $ind->id_indicador }}">
                          <i class="glyphicon glyphicon-trash"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade eliminar{{ $ind->id_indicador }}" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Eliminando registro: {{ $ind->nombre }}</h4>
                              </div>
                              <div class="modal-body">
                                <p>Estas seguro/a de que deseas eliminar este registro?</p>
                              </div>
                              <div class="modal-footer">

                                <!--{!!  Form::open(array( 'route'=>['admin.usuarios.store','post'] ))  !!}-->
                                {!!  Form::open(array( 'route'=>['admin.indicadores.destroy', $ind->id_indicador], 'method'=>'delete' ))  !!}
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="submit" name="btnborrar" class="btn btn-danger">Eliminar</button>
                                {!!  Form::close()  !!}
                              </div>
                            </div>
                          </div>
                        </div>
                    </th>
                  </tr>
                @empty
                  <p>Sin Registros</p>
                @endforelse
              </tbody>
              </table>

          </th>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade editar" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title txtcenter-sans" id="gridSystemModalLabel">Editar a: <b id="nomModal"></b>.</h4>
      </div>
      @if(count($indicadores)>=1)
          {!!  Form::open(array('route'=>['admin.indicadores.edit', $ind->id_indicador], 'method'=>'GET' ))  !!}
            <div class="modal-body">
              <input type="hidden" name="id" id="idEditar" value="">
              <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="nameEditar" id="nameEditar" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Area Responsable</label>
                <input type="text" name="areaEditar" id="areaEditar" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Objetivo</label>
                <input type="text" name="objetivoEditar" id="objetivoEditar" value="" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dagner" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Editar</button>
            </div>
        {!! Form::close() !!}
      @endif
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
@endsection
<div class="modal fade usuarios" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title txtcenter-sans" id="gridSystemModalLabel">Agrega una nueva ingenieria.</h4>
      </div>
      <div class="modal-body">
        <div class="card-body">

          {{ Form::open (array('url'=>'/administracion/indicadores','files'=>"true") )}}
          <fieldset>
            <div class="form-group">
              <label for="">Nombre</label>
                  {{ Form::text('nombre','',array('class'=>'form-control','placeholder'=>'Nombre')  )}}
            </div>
            <div class="form-group">
              <label for="">Area Responsable</label>
                  {{ Form::text('area','',array('class'=>'form-control','placeholder'=>'Nombre')  )}}
            </div>
            <div class="form-group">
              <label for="">Objetivo</label>
                  {{ Form::text('objetivo','',array('class'=>'form-control','placeholder'=>'Nombre')  )}}
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
@section('jQueryUsuarios')
  <script type="text/javascript">
    $(document).ready(function(){
      $(".btnedit").on("click", function(){
        var nom=$(this).data('nombre');
        var area=$(this).data('area');
        var obj=$(this).data('objetivo');
        var id = $(this).data('id');


        //var em=$(this).data('email');
        $("#idEditar").val(id);
        $('#nameEditar').val(nom);
        $('#areaEditar').val(area);
        $('#objetivoEditar').val(obj);
        $("#nomModal").text(nom);

      });
    });
  </script>
@endsection
