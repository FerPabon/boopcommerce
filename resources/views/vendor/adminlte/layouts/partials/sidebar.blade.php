<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu">

            <li class="header"></li>
            <li class="treeview">
                <a href="{{url('estadistica')}}" style="text-decoration:none">
                    <i class="fa fa-tachometer"></i> <span>Estadistica</span>
                    <small class="label pull-right bg-blue">I+O</small>

                </a>

            </li>


            <li class="treeview">
                <a href="" style="text-decoration:none">
                    <i class="fa fa-laptop"></i>
                    <span>Almacén</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{url('almacen/articulo')}}"><i class="fa fa-circle-o"></i> Artículos</a></li>
                    <li><a href="{{url('almacen/categoria')}}"><i class="fa fa-circle-o"></i> Categorías</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#" style="text-decoration:none">
                    <i class="fa fa-credit-card"></i>
                    <span>Compras</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('compras/ingreso')}}"><i class="fa fa-circle-o"></i>Ingresos</a></li>
                    <li><a href="{{url('compras/proveedor')}}"><i class="fa fa-circle-o"></i>Proveedores</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#" style="text-decoration:none">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Ventas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('ventas/venta')}}"><i class="fa fa-circle-o"></i> Ventas</a></li>
                    <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#" style="text-decoration:none">
                    <i class='fa fa-users'></i>
                    <span>Acceso</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('listado_usuarios') }}"><i class="fa fa-circle-o"></i>Usuarios</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>

            <li>
                <a href="{{url('reportes')}}" style="text-decoration:none">
                    <i class="fa fa-plus-square"></i> <span>Reporte</span>
                    <small class="label pull-right bg-red">PDF</small>
                </a>

            </li>
            <li>
                <a href="{{url('acerca')}}" style="text-decoration:none">
                    <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                    <small class="label pull-right bg-yellow">IT</small>
                </a>
            </li>

        </ul>

    </section>
    <!-- /.sidebar -->
</aside>
