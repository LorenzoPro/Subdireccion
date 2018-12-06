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

@section('usuarios')
<div class="row">
  <div class="title" style="text-align: center;"><i class="fas fa-users padRight"></i>Usuarios</div>
  <div class="subtitle" style="text-align: center">Consulta, agrega y elimina.</div>
</div>
<button type="button" class="btnagregar navbar-right btnCirculo" data-toggle="modal" data-target=".usuarios">
    <i class="fas fa-user-plus"></i>
</button>
<button type="button" id="btndatos" class="btnagregar btn btn-success navbar-right btnCirculo2 btnasignar" data-toggle="modal" data-target=".asignar">
  <i class="fas fa-plus"></i>
</button>
<div class="row">
  <div class="table col-md-10 col-sm-10 col-lg-10" style="padding-left:80px; padding-right:80px;">

            <table class="table" id="customers">
              <thead>
                <tr>
                  <!-- <th>#</th> -->
                  <td>Nombre</td>
                  <td>Correo</td>
                  <td>Privilegios</td>
                  <td>Editar</td>
                  <td>Borrar</td>
                </tr>
              </thead>
              <tbody>
                @forelse($usuarios as $usu)
                  <tr>
                    <!-- <th>{{ $usu->id }}</th> -->
                    <th>{{ $usu->name }}</th>
                    <th>{{ $usu->email }}</th>
                    <th>{{ $usu->privilegios }}</th>
                    <th class="centro">
                      <button type="button" name="btneditar" data-toggle="modal" data-target=".editar" class="btn btnedit"
                      data-id="{{ $usu->id }}"
                      data-name="{{  $usu->name  }}"
                      data-email="{{  $usu->email  }}"
                      data-privilegios="{{  $usu->privilegios  }}"
                      >
                        <i class="fas fa-edit"></i>
                      </button>
                    </th>
                    <th class="centro">
                        <button class="btn" type="button"  data-toggle="modal" data-target=".eliminar{{ $usu->id }}">
                          <i class="fas fa-trash"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade eliminar{{ $usu->id }}" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Eliminando registro: {{ $usu->name }}</h4>
                              </div>
                              <div class="modal-body">
                                <p>Estas seguro/a de que deseas eliminar este registro?</p>
                              </div>
                              <div class="modal-footer">

                                <!--{!!  Form::open(array( 'route'=>['admin.usuarios.store','post'] ))  !!}-->
                                {!!  Form::open(array( 'route'=>['admin.usuarios.destroy', $usu->id], 'method'=>'delete' ))  !!}
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

  </div>
</div>

 <div class="row">
   <div class="table col-md-10 col-sm-10 col-lg-10" style="padding-left:80px; padding-right:80px;">
     <table class="table" id="customers">
       <thead>
         <tr>
           <td>Indicadores de los Usuarios</td>
         </tr>
       </thead>
     </table>
     @forelse($usuarios as $usu)
     <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
     <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$usu->id}}" aria-expanded="true" aria-controls="collapseOne" style="font-size:20px;">
            <i class="fas fa-caret-right"></i>{{ $usu->name }}
          </a>
        </h4>
      </div>
      <div id="{{ $usu->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
          <table class="table" id="customers">

            <tbody>
              @forelse($asignaciones as $asi)
              <tr>
                @if($usu->id==$asi->id)
                <th>{{ $asi->nombre }}</th>
                <th>
                  <button class="btn" type="button" data-toggle="modal" data-target=".eliminar2{{ $asi->id_indicador }}">
                    <i class="fas fa-trash"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade eliminar2{{ $asi->id_indicador }}" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Eliminando Asignación:{{ $asi->nombre }}</h4>
                        </div>
                        <div class="modal-body">
                          <p>¿Estás seguro/a de que deseas eliminarlo?</p>
                        </div>
                        <div class="modal-footer">

                          <!--{!!  Form::open(array( 'route'=>['admin.usuarios.store','post'] ))  !!}-->
                          {!!  Form::open(array( 'route'=>['admin.asignaciones.destroy', $asi->id_asignaciones], 'method'=>'delete' ))  !!}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnborrar" class="btn btn-danger">Eliminar</button>
                          {!!  Form::close()  !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </th>
              </tr>
                @endif
              @empty
                <p>Sin Registros</p>
              @endforelse
            </tbody>
          </table>

        </div>
      </div>
    </div>
    </div>
    @empty
      <p>Sin Registros</p>
    @endforelse
   </div>


 </div>

<div class="modal fade editar" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title txtcenter-sans" id="gridSystemModalLabel">Editar a: <b id="nomModal">Daniel</b>.</h4>
      </div>
      @if(count($usuarios)>=1)
          {!!  Form::open(array('route'=>['admin.usuarios.edit', $usu->id], 'method'=>'GET' ))  !!}
            <div class="modal-body">
              <input type="hidden" name="id" id="idEditar" value="">
              <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="nameEditar" id="nameEditar" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Correo electronico</label>
                <input type="text" name="nameEmail" id="nameEmail" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Privilegios</label>
                <select class="form-control" name="editarPrivilegios" id="editarPrivilegios">
                  <option value="Administrador">Administrador</option>
                  <option value="Editor">Editor</option>
                </select>
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
        <h4 class="modal-title txtcenter-sans" id="gridSystemModalLabel">Agrega un usuario nuevo.</h4>
      </div>
      <div class="modal-body">
        <div class="card-body">

          {{ Form::open (array('url'=>'/administracion/usuarios','files'=>"true") )}}
          <fieldset>
            <div class="form-group">
              <label for="">Nombre</label>
                  {{ Form::text('nombre','',array('class'=>'form-control','placeholder'=>'Nombre')  )}}

            </div>
            <div class="form-group">
              <label for="">Correo</label>
                  {{ Form::email('correo','',array('class'=>'form-control','placeholder'=>'Correo')  )}}
            </div>
            <div class="form-group">
              <label for="">Contraseña</label>
                  {{ Form::password('contrasena1',array('class'=>'form-control','placeholder'=>'Contraseña')  )}}
            </div>
            <div class="form-group">
              <label for="">Contraseña</label>
                  {{ Form::password('contrasena2',array('class'=>'form-control','placeholder'=>'Confirma contraseña')  )}}
            </div>
            <div class="form-group">
              <label for="">Privilegios</label><br>
              {{  Form::select('privilegios',[
              'Administrador' => 'Administrador',
              'Editor' => 'Editor'],null,['class'=>'form-control']  )}}
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

<div class="modal fade asignar" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title txtcenter-sans" id="gridSystemModalLabel">Agrega un usuario nuevo.</h4>
      </div>
      <div class="modal-body">
        <div class="card-body">

          {{ Form::open (array('url'=>'/administracion/asignaciones') )}}
          <fieldset>
            <div class="form-group">
              <label for="">Usuario</label>
              <select class="cate form-control" name="id" id="id">
                <option value="" disabled selected>--Seleciona el Usuario--</option>
                @forelse($usuarios as $usu)
                  <option value="{{$usu->id}}" data-id="{{ $usu->id }}" class="usuario">{{$usu->name}}</option>
                @empty
                  <option value=""></option>
                @endforelse
              </select>
              <br>
              <label for="">Indicadores</label>
              <select class="cate form-control" name="id_indicador" id="indicador">
                <option value="" disabled selected>--Seleciona el Indicador--</option>
                @forelse($indicadores as $ind)
                  <option value="{{$ind->id_indicador}}" data-id="{{ $ind->id_indicador }}" data-id2="{{$ind->id_indicador}}" class="indicador">{{$ind->nombre}}</option>
                @empty
                  <option value=""></option>
                @endforelse
              </select>
            </div>
            <div class="form-group">
                {{ Form::submit('Asignar',array('class'=>'btn btn-primary')  )}}
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
        var nom=$(this).data('name');
        var id = $(this).data('id');
        var email = $(this).data('email');
        var priv = $(this).data('privilegios');

        //var em=$(this).data('email');
        $("#idEditar").val(id);
        $('#nameEditar').val(nom);
        $('#nameEmail').val(email);
        $('#editarPrivilegios').val(priv);
        $("#nomModal").text(nom);

      });
      $('.btnasignar').on("click", function(){
      //  var nom2=$(this).data('id');
      //  $('#nameEditar').val(nom2);
      //  $('#idForm').val(nom2);
        $.ajax({
          method:'POST',
          url:'/administracion/usuarios/ajax',
          data: $('#miForm').serialize(),
        }).done(function (respuesta){
          $('#comboAjax').find('option').remove();
          console.log(respuesta);
          $('#comboAjax').append(respuesta);
        });

      });
    });
  </script>
@endsection
