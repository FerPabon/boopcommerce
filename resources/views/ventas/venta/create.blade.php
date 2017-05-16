@extends('adminlte::layouts.app')


@section('main-content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Venta</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}


    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="proveedor">Cliente</label>
                <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
                    @foreach($personas as $persona)
                        <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>

                    @endforeach
                </select>
            </div>

        </div>


        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="proveedor">Tipo Comprobante</label>
                <select name="tipo_comprobante" class="form-control">
                    <option value="Factura">Factura</option>
                    <option value="Boleta">Boleta</option>
                    <option value="Ticket">Ticket</option>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Serie Comprobante</label>
                <input type="text" name="serie_comprobante" value="001" class="form-control" placeholder="serie comprobante...">
            </div>
        </div>


        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="num_comprobante">Número Comprobante</label>
                <input type="text" name="num_comprobante" required value="0001" class="form-control" placeholder="numero comprobante...">
            </div>
        </div>

    </div>



    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">

                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Articulo</label>
                        <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                            <option>Lista de Articulos</option>
                            @foreach($articulos as $articulo)
                                <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_venta}}">{{$articulo->articulo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="pcanditad" id="pcantidad" class="form-control" placeholder="Cantidad...">
                    </div>
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock...">
                    </div>
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="precio_venta">Precio Venta</label>
                        <input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Precio venta...">
                    </div>
                </div>


                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="descuento">Descuento</label>
                        <input type="number" name="pdescuento" id="pdescuento" class="form-control" value="0" placeholder="Descuento...">
                    </div>
                </div>


                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#ADBAD4">
                        <th>Opciones</th>
                        <th>Articulo</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                        <th>Descuento</th>
                        <th>Subtotal</th>

                        </thead>
                        <tfoot>
                        <th>TOTAL</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><h4 id="total">0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>

                        </tfoot>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
            <div class="form-group">
                <input name="_token" value="{{csrf_token()}}" type="hidden"> </input>
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @push ('scripts-footer')


    <script>

        $(document).ready(function(){
            $('#bt_add').click(function(){
                agregar();
            });
        });

        var cont=0;
        total=0;
        total_venta=0;
        subtotal=[];
        var cantidad =0;

        $("#guardar").hide();
        $("#pidarticulo").change(mostrarValores);


        function mostrarValores() {
            datosArticulo=document.getElementById('pidarticulo').value.split('_');
            $("#pprecio_venta").val((datosArticulo[2]));
            $("#pstock").val((datosArticulo[1]));
        }


        function agregar() {
            datosArticulo=document.getElementById('pidarticulo').value.split('_');
            idarticulo=datosArticulo[0];
            articulo=$("#pidarticulo option:selected").text();

            cantidad= parseInt($("#pcantidad").val());
            var stock= parseInt($("#pstock").val());
            precio_venta=$("#pprecio_venta").val();
            descuento=$("#pdescuento").val();


            if (idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!="") {

                if(stock >= cantidad) {
                    subtotal[cont] = (cantidad * precio_venta-descuento);
                    total = total+subtotal[cont];

                    var fila = '<tr class="selected" id="fila' + cont + '">' +
                        '<td>'+'<button type="button" class="btn btn-danger" onclick="eliminar(' + cont + ');">X</button>'+
                        '<td><input type="hidden" name="idarticulo[]" value="' + idarticulo + '">' + articulo + '</td>' +
                        '<td><input type="number" readonly="readonly" name="cantidad[]" value="' + cantidad + '"></td>' +
                        '<td><input type="number" readonly="readonly" name ="precio_venta[]" value="' + precio_venta + '"></td>' +
                        '<td><input type="number" readonly="readonly" name="descuento[]"   value="' + descuento + '"></td>' +
                        '<td>' + subtotal[cont] + '</td>' +
                        '</tr>';

                    cont++;

                    $("#total").html("COP $. " + total);
                    $("#total_venta").val(total);

                    $('#detalles').append(fila);

                    evaluar();


                }else{
                    alert('La cantidad a vender supera el stock.')
                }

            }
            else{
                alert("Error al ingresar el detalle del venta, revise los datos del articulo");
            }

        }


        function evaluar() {
            if (total>0) {

                $("#guardar").show();
            }
            else
            {
                $("#guardar").hide();
            }
        }

        function eliminar(index){
            total=total-subtotal[index];
            $("#total").html("$/. " + total);
            $("#total_venta").val(total);
            $("#fila" + index).remove();
            evaluar();

        }

    </script>
    @endpush

@endsection

