<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table='productos';
    protected $primaryKey='idprod';
    public $timestamps=false;

    protected $fillable= [
    	'nomprod',
    	'estado',
        'modelo',
        'imagen',
        'ficha_tec'
    ];

    protected $guarded =[

    ];
}
