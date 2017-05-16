<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="skin-blue sidebar-mini">
<div id="app">


    <div style="display: none;" id="cargador_empresa" align="center">
        <br>
        <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>
        <img src="{{ url('/img/cargando.gif') }}" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>
        <br>
        <hr style="color:#003" width="50%">
        <br>
    </div>

    <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />

    <div id="capa_modal" class="div_modal"></div>
    <div id="capa_formularios" class="div_contenido" ></div>


    <div class="wrapper">
        @include('adminlte::layouts.partials.mainheader')
        @include('adminlte::layouts.partials.sidebar')


        <div class="content-wrapper">

            <section class="content">

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">

                            <div class="box-header with-border">
                                <h3 class="box-title">Sistema de Inventario</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        <section>
                                            @yield('main-content')

                                        </section>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

            @include('adminlte::layouts.partials.controlsidebar')
            @include('adminlte::layouts.partials.footer')
    </div>
</div>

@section('scripts')
    @include('adminlte::layouts.partials.scripts')
    @stack('scripts-footer')
@show

</body>
</html>
