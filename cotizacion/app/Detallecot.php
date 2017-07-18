<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallecot extends Model
{
    //
    protected $table='detallecot';
    protected $primaryKey='iddetalle';
    public $timestamps=false;

    protected $fillable= [
    	'idcotizacion',
    	'idprod',
    	'cantidad',
    	'importe',
        'estado',
    ];

    protected $guarded =[

    ];
}
