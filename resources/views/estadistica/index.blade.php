@extends('adminlte::layouts.app')

@section('main-content')

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$temp}}</h3>

                    <p>Ventas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a class="small-box-footer">Ventas/mes</a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$aux}}</h3>

                    <p>Compras</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a class="small-box-footer">Ingresos/mes</a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$cliente}}</h3>
                    <p>Clientes</p>
                </div>

                <div class="icon">
                    <i class="ion-ios-people"></i>
                </div>
                <a class="small-box-footer">Clientes nuevos/mes</a>
            </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$num_users}}</h3>

                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion-person-add"></i>
                </div>
                <a class="small-box-footer">Usuarios registrados</a>
            </div>
        </div>

    </div>


@endsection


