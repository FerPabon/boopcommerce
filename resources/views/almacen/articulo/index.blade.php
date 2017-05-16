@extends('adminlte::layouts.app')


@section('main-content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Articulos <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('almacen.articulo.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Precio Venta</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Opciones</th>

                    </thead>
                    @foreach ($articulos as $art)
                        <tr>
                            <td>{{ $art->codigo}}</td>
                            <td>{{ $art->nombre}}</td>
                            <td>{{ $art->categoria}}</td>
                            <td>{{ $art->stock}}</td>
                            <td>{{ $art->precio_venta}}</td>

                            <td>
                                <img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100px" width="100px" class="img-thumbnail">
                            </td>
                            <td>{{ $art->estado }}</td>

                            <td>
                                <a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info">Editar</button></a>
                                <a href="" data-target="#modal{{$art->idarticulo}}"data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

                                <div class="modal fade" id="modal{{$art->idarticulo}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    {{Form::open(['route'=>['articulo.destroy',$art->idarticulo],'method'=>'DELETE'])}}
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Elminiar categoria</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente desea eliminar la categoria {{$art->nombre}}?</p>
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
            {{$articulos->render()}}
        </div>
    </div>

@endsection