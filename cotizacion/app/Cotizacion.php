<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table='cotizaciones';
    protected $primaryKey='idcotizacion';
    public $timestamps=true;

    protected $fillable= [
    	'idcte',
    	'total',
    	'created_at',
    	'estado',
    	'updated_at'
    ];

    protected $guarded =[

    ];
}
