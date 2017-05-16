@extends('adminlte::layouts.app')


@section('main-content')

	<section  id="contenido_principal">

				<h3 class="box-title">Listado de usuarios
					<a href="javascript:void(0);" class="btn btn-success" onclick="cargar_formulario(1);">Nuevo</a>
					<a href="javascript:void(0);" class="btn btn btn-primary" onclick="cargar_formulario(2);">Roles</a>
					<a href="javascript:void(0);" class="btn btn btn-primary" onclick="cargar_formulario(3);" >Permisos</a>

				</h3>

		<div class="form-group">
				<form  action="{{ url('buscar_usuario') }}"  method="post"  >
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<div class="input-group input-group-sm">
						<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required>
						<span class="input-group-btn">
							<input type="submit" class="btn btn-primary" value="buscar" >
						</span>
					</div>
				</form>
		</div>


		<div class="table-responsive" >
			<table  class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				<tr>
					<th>codigo</th>
					<th>Rol</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Acción</th>
				</tr>
				</thead>

		<tbody>


	    @foreach($usuarios as $usuario)
			<tr role="row" class="odd">
				<td>{{ $usuario->id }}</td>
				<td>
					<span class="label label-default">

					@foreach($usuario->getRoles() as $roles)
						{{  $roles.","  }}
					@endforeach
					</span>
				</td>

				<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"  style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $usuario->nombres  }}</a></td>
				<td>{{ $usuario->email }}</td>

				<td>
				<button type="button" class="btn  btn-default btn-xs" onclick="verinfo_usuario({{  $usuario->id }})" ><i class="fa fa-fw fa-edit"></i></button>
				<button type="button"  class="btn  btn-danger btn-xs"  onclick="borrado_usuario({{  $usuario->id }});"  ><i class="fa fa-fw fa-remove"></i></button>

				</td>
			</tr>
	    @endforeach


		</tbody>
			</table>
		</div>




{{ $usuarios->links() }}
			@if(count($usuarios)==0)
				<div class="box box-primary col-xs-12">
					<div class='aprobado' style="margin-top:70px; text-align: center">
						<label style='color:#177F6B'>... no se encontraron resultados para su busqueda...</label>
					</div>
				</div>
			@endif


	</section>

@endsection