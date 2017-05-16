<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PDFController extends Controller
{

    public function index(){
        return view('reportes.index');

    }

    public function crearPDF(){

        $usuario= User::All();
        $pdf = \PDF::loadView('reportes/reporte',['user'=>$usuario]);
        return $pdf->download('archivo.pdf');
    }

    public function VerPDF(){

        $usuario= User::All();
        $pdf = \PDF::loadView('reportes/show',['user'=>$usuario]);
        return $pdf->stream('archivo.pdf');

    }

    public function reporteVentas(Request $request){

            $mytime = Carbon::now('America/Bogota')->toDateTimeString();

                $ventasR = DB::table('venta as v')
                    ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
                    ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
                    ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
                    ->where('v.estado','=','Activa')
                    ->whereBetween('v.fecha_hora', [$request->date, $request->date2])
                    ->orderBy('v.idventa', 'desc')
                    ->groupBy('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
                    ->paginate(7);

                $ventasR=\PDF::loadView('reportes/ventas',["ventas" => $ventasR,'fecha'=>$mytime]);
                $ventasR->setPaper('legal', 'landscape')->download('invoice.pdf');
                return $ventasR->stream('ventas.pdf');

            }

}
