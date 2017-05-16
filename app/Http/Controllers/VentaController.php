<?php

namespace App\Http\Controllers;
use App\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VentaFormRequest;
use App\Venta;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


      public function index(Request $request){
          if ($request) {
              $query = trim($request->get('searchText'));
              $ventas = DB::table('venta as v')
                  ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
                  ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
                  ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
                  ->where('v.num_comprobante', 'LIKE', '%' . $query . '%')
                  ->orwhere('v.serie_comprobante', 'LIKE', '%' . $query . '%')
                  ->orderBy('v.idventa', 'desc')
                  ->groupBy('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
                  ->paginate(20);
              return view('ventas.venta.index', ["ventas" => $ventas, "searchText" => $query]);

          }
      }


    public function create(){

        $personas = DB::table('persona')->where('tipo_persona', '=', 'Cliente')->get();
        $articulos = DB::table('articulo as art')

            ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'), 'art.idarticulo', 'art.stock','art.precio_venta')
            ->where('art.estado', '=', 'activo')
            ->where('art.stock', '>', '0')
            ->groupBy('articulo', 'art.idarticulo', 'art.stock','art.precio_venta')
            ->get();



        return view("ventas.venta.create", ["personas" => $personas, "articulos" => $articulos]);
    }

    public function store(VentaFormRequest $request){

        DB::beginTransaction();
        $venta = new Venta;
        $venta->idcliente = $request->get('idcliente');
        $venta->tipo_comprobante = $request->get('tipo_comprobante');
        $venta->serie_comprobante = $request->get('serie_comprobante');
        $venta->num_comprobante = $request->get('num_comprobante');

        $mytime = Carbon::now('America/Bogota');
        $venta->fecha_hora = $mytime->toDateTimeString();

        $venta->impuesto = '0';
        $venta->total_venta = $request->get('total_venta');
        $venta->estado = 'Activa';
        $venta->save();

        $idarticulo = $request->get('idarticulo');
        $cantidad = $request->get('cantidad');
        $precio_venta = $request->get('precio_venta');
        $descuento = $request->get('descuento');


        $cont = 0;

        while ($cont < count($idarticulo)) {
            $detalle = new DetalleVenta();
            $detalle->idventa = $venta->idventa;
            $detalle->idarticulo = $idarticulo[$cont];
            $detalle->cantidad = $cantidad[$cont];
            $detalle->precio_venta = $precio_venta[$cont];
            $detalle->descuento = $descuento[$cont];
            $detalle->anulado='0';

            $detalle->save();
            $cont = $cont + 1;
        }

        DB::commit();
        return Redirect::to('ventas/venta');
    }

    public function show($id){
        $venta = DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
            ->where('v.idventa', '=', $id)
            ->first();

        $detalles = DB::table('detalle_venta as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.descuento', 'd.precio_venta')
            ->where('d.idventa', '=', $id)
            ->get();
        return view("ventas.venta.show", ["venta" => $venta, "detalles" => $detalles]);
    }

    public function destroy($id){
        $venta = Venta::findOrFail($id);
        $venta->Estado = 'Anulada';
        $venta->update();

        DB::select('CALL anularventa()');

        return Redirect::to('ventas/venta');
    }
}