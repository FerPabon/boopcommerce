@extends('adminlte::layouts.app')

@section('main-content')


    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <h3>Listado de reportes</h3>
        </div>
    </div>


    {!!Form::open(array('url'=>'reportes/ventas','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <div class="box-body table-responsive no-padding"  style=" height: 390px; overflow: auto;">
                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>reporte</th>
                            <th>Fecha Inicial</th>
                            <th>Fecha Final</th>
                            <th>ver</th>
                            <th>descargar</th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td>1</td>
                            <td>Reporte de Ventas</td>
                            <td>

                                <div class="form-group">
                                <div class="input-group date">
                                    <div class="input-group date" id="datetimepicker1">
                                        <input type="text" class="form-control" name="date" required>
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>


                            <td>
                                <div class="input-group date">
                                    <div class="input-group date" id="datetimepicker2">
                                        <input type="text" class="form-control" name="date2" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>


                            <td><a href="{{'reportes/ventas'}}"><button type="submit"  class="btn btn-block btn-primary" >Ver</button></a></td>
                            <td><a href="{{'reportes/reporte'}}"><button class="btn btn-block btn-success">Descargar</button></a></td>
                        </tr>
                        {!! Form::close() !!}


                        </tbody>

                    </table>


                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts-footer')

<script>

    $(document).ready(function() {

        $(function () {
            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'YYYY/MM/DD HH:mm:ss'

            });
        });

        $(function () {
            $('#datetimepicker2').datetimepicker({
                locale: 'es',
                format: 'YYYY/MM/DD HH:mm:ss'
            });
        });


    });

</script>
@endpush