@extends('adminlte::layouts.app')


@section('main-content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Categorías <a href="categoria/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('almacen.categoria.search')

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Opciones</th>
                    </thead>


                    @foreach ($categorias as $cat)

                        <tr>
                            <td>{{ $cat->idcategoria}}</td>
                            <td>{{ $cat->nombre}}</td>
                            <td>{{ $cat->descripcion}}</td>
                            <td>
                                <a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn btn-info">Editar</button></a>
                                <a href="" data-target="#modal{{$cat->idcategoria}}"data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

                                <div class="modal fade" id="modal{{$cat->idcategoria}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    {{Form::open(['route'=>['categoria.destroy',$cat->idcategoria],'method'=>'DELETE'])}}
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Elminiar categoria</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente desea eliminar la categoria {{$cat->nombre}}?</p>
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
            {{$categorias->render()}}
        </div>
    </div>

@endsection




