<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Detallecot;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DetallecotFormRequest;
use DB;
use Storage;

class DetallecotController extends Controller
{
    //
    public function __construct(){

    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));
    		$detallecot=DB::table('detallecot as det')
    		->join('cotizaciones as cot','det.idcotizacion','=','cot.idcotizacion')
    		->join('productos as prod','det.idprod','=','prod.idprod')
    		->select('det.iddetalle','cot.idcotizacion','prod.nomprod','prod.precio','det.cantidad','det.importe')
            ->where('cot.idcotizacion','LIKE','%'.$query.'%')
    		->orderBy('cot.idcotizacion','desc')
    		->paginate(5);
    		return view('detallecot.index',["detallecot"=>$detallecot,"searchText"=>$query]);
    	}

    }

    public function create(){
        $productos=DB::table('productos')->where('estado','=','1')->get();
        $cotizaciones=DB::table('cotizaciones')->where('estado','=','1')->get();
    	return view("detallecot.create",["productos"=>$productos,"cotizaciones"=>$cotizaciones]);
    }   

    public function store(DetallecotFormRequest $request){
    	$detallecot=new Detallecot;
    	$detallecot->idcotizacion=$request->get('idcotizacion');
    	$detallecot->idprod=$request->get('idprod');
    	$detallecot->cantidad=$request->get('cantidad');
    	$detallecot->estado='1';
    	$detallecot->save();
    	return Redirect::to('detallecot');
    }

    public function show($id){
    	return view("detallecot.show",["detallecot"=>Detallecot::findOrFail($id)]);
    }

    public function edit($id){
        $cotizacion=Cotizacion::findOrFail($id);
        $clientes=DB::table('clientes')->where('estado','=','1')->get();
    	return view("cotizaciones.edit",["cotizacion"=>$cotizacion,"clientes"=>$clientes]);
    }

    public  function update(CotizacionFormRequest $request, $id){
    	$cotizacion=Cotizacion::findOrFail($id);
    	$cotizacion->idcte=$request->get('idcte');
    	$cotizacion->update();
    	return Redirect::to('cotizaciones');
    }

    public function destroy($id){
    	$detallecot=Detallecot::findOrFail($id);
    	$detallecot->estado='0';
    	$detallecot->update();
    	return Redirect::to('detallecot');
    }
}
