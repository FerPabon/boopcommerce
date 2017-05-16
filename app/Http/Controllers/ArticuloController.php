<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticuloFormRequest;
use App\Articulo;
use DB;


class ArticuloController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $articulos = DB::table('articulo as a')
                ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                ->select('a.idarticulo','a.codigo', 'a.nombre','c.nombre as categoria', 'a.stock','a.precio_venta', 'a.imagen', 'a.estado')
                ->where('a.nombre', 'LIKE', '%' . $query . '%')
                ->orwhere('a.codigo', 'LIKE', '%' . $query . '%')
                ->orderBy('a.idarticulo','desc')
                ->paginate(20);
            return view('almacen.articulo.index', ["articulos" => $articulos, "searchText" => $query]);
        }
    }

    public function create()
    {
        $categorias = DB::table('categoria')->where('condicion', '=', '1')->get();
        return view("almacen.articulo.create", ["categorias" => $categorias]);
    }


    public function store(ArticuloFormRequest $request)
    {
        $articulo = new Articulo;
        $articulo->idcategoria = $request->get('idcategoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock='0';
        $articulo->precio_venta='0';
        $articulo->descripcion = $request->get('descripcion');


        if (Input::hasFile('imagen')) {
            $file = Input::file('imagen');
            $file->move(public_path() . '/imagenes/articulos/', $file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }

        $articulo->estado = 'activo';
        $articulo->save();
        return Redirect::to('almacen/articulo');

    }

    public function show($id)
    {
        return view("almacen.articulo.show", ["articulo"=> Articulo::findOrFail($id)]);
    }

    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }

    /**
     * @param ArticuloFormRequest $request
     * @param $id
     * @return mixed
     */
    public function update(ArticuloFormRequest $request, $id)
    {
        $articulo = Articulo::findOrFail($id);

        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo =$request->get('codigo');
        $articulo->nombre= $request->get('nombre');
        $articulo->precio_venta=$request->get('precio_venta');
        $articulo->descripcion=$request->get('descripcion');


        if (Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
        $articulo->update();
        return Redirect::to('almacen/articulo');


    }

    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->estado = 'Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }

}
