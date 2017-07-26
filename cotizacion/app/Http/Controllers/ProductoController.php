<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Producto;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use DB;
use Storage;

class ProductoController extends Controller
{
    //
    public function __construct(){

    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));
    		$productos=DB::table('productos')->where('nomprod','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idprod','desc')
    		->paginate(7);
    		return view('productos.index',["productos"=>$productos,"searchText"=>$query]);
    	}

    }

    public function create(){
    	return view("productos.create");
    }

    public function store(ProductoFormRequest $request){
    	$producto=new Producto;
        $producto->modelo=$request->get('modelo');
    	$producto->nomprod=$request->get('nombre');
        $producto->imagen=$request->get('imagen');
        $producto->ficha_tec=$request->get('ficha_tec');
    	$producto->estado='1';
    	$producto->save();
    	return Redirect::to('productos');
    }

    public function show($id){
    	return view("productos.show",["producto"=>Producto::findOrFail($id)]);
    }

    public function edit($id){
    	return view("productos.edit",["producto"=>Producto::findOrFail($id)]);
    }

    public  function update(ProductoFormRequest $request, $id){
    	$producto=Producto::findOrFail($id);
        $producto->modelo=$request->get('modelo');
    	$producto->nomprod=$request->get('nombre');
        $producto->imagen=$request->get('imagen');
        $producto->ficha_tec=$request->get('ficha_tec');
    	$producto->update();
    	return Redirect::to('productos');
    }

    public function destroy($id){
    	$producto=Producto::findOrFail($id);
    	$producto->estado='0';
    	$producto->update();
    	return Redirect::to('productos');
    }
}
