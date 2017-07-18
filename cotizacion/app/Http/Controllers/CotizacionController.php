<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cotizacion;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CotizacionFormRequest;
use DB;
use Storage;

class CotizacionController extends Controller
{
    //
    public function __construct(){

    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));
    		$cotizaciones=DB::table('cotizaciones as cot')
    		->join('clientes as cte','cot.idcte','=','cte.idcte')
    		->select('cot.idcotizacion','cte.nomcte','cot.created_at')
    		->where('cte.nomcte','LIKE','%'.$query.'%')
            ->orwhere('cot.idcotizacion','LIKE','%'.$query.'%')
    		->orderBy('cot.idcotizacion','desc')
    		->paginate(5);
    		return view('cotizaciones.index',["cotizaciones"=>$cotizaciones,"searchText"=>$query]);
    	}

    }

    public function create(){
        $clientes=DB::table('clientes')->where('estado','=','1')->get();
    	return view("cotizaciones.create",["clientes"=>$clientes]);
    }   

    public function store(CotizacionFormRequest $request){
    	$cotizacion=new Cotizacion;
    	$cotizacion->idcte=$request->get('idcte');
    	$cotizacion->estado='1';
    	$cotizacion->save();
    	return Redirect::to('cotizaciones');
    }

    public function show($id){
    	return view("cotizaciones.show",["cotizacion"=>Cotizacion::findOrFail($id)]);
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
    	$cotizacion=Cotizacion::findOrFail($id);
    	$cotizacion->estado='0';
    	$cotizacion->update();
    	return Redirect::to('cotizaciones');
    }
}
