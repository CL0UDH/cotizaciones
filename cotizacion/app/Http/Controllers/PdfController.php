<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Storage;
use PDF;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PdfController extends Controller
{
    //
    public function __construct(){

    }

    public function show($id){
    	$cotizacion=DB::table('cotizaciones as cot')
        ->join('clientes as cte','cot.idcte','=','cte.idcte')
        ->join('detallecot as det','cot.idcotizacion','=','det.idcotizacion')
        ->select('cot.idcotizacion','cot.created_at','cte.nomcte','cte.empresa','cte.domicilio','cte.telefono','cte.email','cot.estado',DB::raw('sum(det.cantidad*precio) as total'))
        ->where('cot.idcotizacion','=',$id)
        ->groupBy('cot.idcotizacion','cot.created_at','cte.nomcte','cte.empresa','cte.domicilio','cte.telefono','cte.email','cot.estado')
        ->first();

        $detalles=DB::table('detallecot as d')
            ->join('productos as p','d.idprod','=','p.idprod')
            ->select('p.nomprod as producto','p.modelo','p.imagen','p.ficha_tec','d.cantidad','d.precio')
            ->where('d.idcotizacion','=',$id)
            ->get();

        $pdf = PDF::loadView('pdf.vista', ["cotizacion"=>$cotizacion,"detalles"=>$detalles]);
		return $pdf->stream('invoice.pdf');
    }
}
