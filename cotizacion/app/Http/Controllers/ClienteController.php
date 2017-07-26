<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ClienteFormRequest;
use DB;
use Storage;

class ClienteController extends Controller
{
    //
    public function __construct(){

    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));
    		$clientes=DB::table('clientes')->where('nomcte','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idcte','desc')
    		->paginate(7);
    		return view('clientes.index',["clientes"=>$clientes,"searchText"=>$query]);
    	}

    }

    public function create(){
    	return view("clientes.create");
    }

    public function store(ClienteFormRequest $request){
    	$cliente=new Cliente;
        $cliente->empresa=$request->get('empresa');
    	$cliente->nomcte=$request->get('nombre');
        $cliente->domicilio=$request->get('domicilio');
        $cliente->telefono=$request->get('telefono');
        $cliente->email=$request->get('email');
    	$cliente->estado='1';
    	$cliente->save();
    	return Redirect::to('clientes');
    }

    public function show($id){
    	return view("clientes.show",["cliente"=>Cliente::findOrFail($id)]);
    }

    public function edit($id){
    	return view("clientes.edit",["cliente"=>Cliente::findOrFail($id)]);
    }

    public  function update(ClienteFormRequest $request, $id){
    	$cliente=Cliente::findOrFail($id);
        $cliente->empresa=$request->get('empresa');
    	$cliente->nomcte=$request->get('nombre');
        $cliente->domicilio=$request->get('domicilio');
        $cliente->telefono=$request->get('telefono');
        $cliente->email=$request->get('email');
    	$cliente->update();
    	return Redirect::to('clientes');
    }

    public function destroy($id){
    	$cliente=Cliente::findOrFail($id);
    	$cliente->estado='0';
    	$cliente->update();
    	return Redirect::to('clientes');
    }
}
