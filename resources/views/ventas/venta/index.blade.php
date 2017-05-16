@extends('adminlte::layouts.app')


@section('main-content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('ventas.venta.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Comprobante</th>
                    <th>Iva</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                    </thead>
                    @foreach ($ventas as $ven)
                        <tr>
                            <td>{{ $ven->fecha_hora}}</td>
                            <td>{{ $ven->nombre}}</td>
                            <td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->num_comprobante}}</td>
                            <td>{{ $ven->impuesto}}</td>
                            <td>{{ $ven->total_venta}}</td>
                            <td>{{ $ven->estado}}</td>
                            <td>
                                <a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a>
                                <a href="" data-target="#modal{{$ven->idventa}}"data-toggle="modal"><button class="btn btn-danger">Anular</button></a>

                                <div class="modal fade" id="modal{{$ven->idventa}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    {{Form::open(['route'=>['venta.destroy',$ven->idventa],'method'=>'DELETE'])}}
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Elminiar categoria</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente desea anular la venta al cliente {{$ven->nombre}}?</p>
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
            {{$ventas->render()}}

        </div>
    </div>

@endsection