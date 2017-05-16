<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
 protected $table = 'detalle_venta';
    protected $primaryKey = 'iddetalle_venta';

    //Creacion y actuzalizacion del registro
    public $timestamps = false;

    protected $fillable = [
    'idventa',
    'idarticulo',
    'cantidad',
    'precio_venta',
    'descuento'

];
    protected $guarded = [

];
}
