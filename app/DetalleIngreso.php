<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table = 'detalle_ingreso';
    protected $primaryKey = 'iddetalle_ingreso';

    //Creacion y actuzalizacion del registro
    public $timestamps = false;

    protected $fillable = [
        'idingreso',
        'idarticulo',
        'cantidad',
        'precio_compra',
        'precio_venta'


    ];

    protected $guarded = [

    ];
}
