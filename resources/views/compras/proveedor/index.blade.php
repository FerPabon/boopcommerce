@extends('adminlte::layouts.app')


@section('main-content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('compras.proveedor.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Tipo Doc.</th>
                    <th>Número</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Opciones</th>
                    </thead>
                    @foreach ($personas as $per)
                        <tr>
                            <td>{{ $per->idpersona}}</td>
                            <td>{{ $per->nombre}}</td>
                            <td>{{ $per->tipo_documento}}</td>
                            <td>{{ $per->num_documento}}</td>
                            <td>{{ $per->telefono}}</td>
                            <td>{{ $per->email}}</td>
                            <td>
                                <a href="{{URL::action('ProveedorController@edit',$per->idpersona)}}"><button class="btn btn-info">Editar</button></a>
                                <a href="" data-target="#modal{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

                                <div class="modal fade" id="modal{{$per->idpersona}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    {{Form::open(['route'=>['proveedor.destroy',$per->idpersona],'method'=>'DELETE'])}}
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Elminiar categoria</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente desea eliminar el proveedor {{$per->nombre}}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                    {!!Form::close()!!}
                                </div>

                            </td>
                        </tr>

                        @endforeach
                </table>
            </div>
            {{$personas->render()}}
        </div>
    </div>

@endsection