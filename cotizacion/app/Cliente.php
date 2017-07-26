<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table='clientes';
    protected $primaryKey='idcte';
    public $timestamps=false;

    protected $fillable =[
    	'nomcte',
        'domicilio',
    	'telefono',
        'email',
        'empresa'
    ];

    protected $guarded =[

    ];
}
