@extends('adminlte::layouts.app')


@section('main-content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('compras.ingreso.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                    </thead>
                    @foreach ($ingresos as $ing)
                        <tr>
                            <td>{{ $ing->fecha_hora}}</td>
                            <td>{{ $ing->nombre}}</td>
                            <td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.'-'.$ing->num_comprobante}}</td>
                            <td>{{ $ing->impuesto}}</td>
                            <td>{{ $ing->total}}</td>
                            <td>{{ $ing->estado}}</td>
                            <td>
                                <a href="{{URL::action('IngresoController@show',$ing->idingreso)}}"><button class="btn btn-primary">Detalles</button></a>
                                <a href="" data-target="#modal{{$ing->idingreso}}"data-toggle="modal"><button class="btn btn-danger">Anular</button></a>

                                <div class="modal fade" id="modal{{$ing->idingreso}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    {{Form::open(['route'=>['ingreso.destroy',$ing->idingreso],'method'=>'DELETE'])}}
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Elminiar categoria</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente desea anular el ingreso del proveedor {{$ing->nombre}}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Anular</button>
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
            {{$ingresos->render()}}

        </div>
    </div>

@endsection