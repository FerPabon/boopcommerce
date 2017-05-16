<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EstadisticaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){

        $venta_mes = DB::select('SELECT ventas_mes() as venta_mes' );
        $temp = (int)$venta_mes[0]->venta_mes;

        $usuarios=DB::select('SELECT numero_usuarios() as usuarios');
        $num_users = (int)$usuarios[0]->usuarios;

        $ingresos_mes=DB::select('SELECT ingresos_mes() as ingreso_mes');
        $aux= (int)$ingresos_mes[0]->ingreso_mes;

        $clientes_mes=DB::select('SELECT clientes_mes() as cliente_mes');
        $cliente= (int)$clientes_mes[0]->cliente_mes;


        return view('estadistica.index',compact('aux','temp','num_users','cliente'));


    }
}
