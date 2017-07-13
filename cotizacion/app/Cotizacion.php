<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table='cotizaciones';
    protected $primaryKey='idcotizacion';
    public $timestamps=false;

    protected $fillable= [
    	'idcte',
    	'total'
    ];

    protected $guarded =[

    ];
}
