<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cotizacion;
use App\Detallecot;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CotizacionFormRequest;
use DB;
use Storage;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

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
            ->join('detallecot as det','cot.idcotizacion','=','det.idcotizacion')
            ->select('cot.idcotizacion','cot.created_at','cte.nomcte','cte.empresa','cot.estado',DB::raw('sum(det.cantidad*precio) as total'))
            ->where('cot.idcotizacion','LIKE','%'.$query.'%')
            ->orwhere('cte.nomcte','LIKE','%'.$query.'%')
            ->orderBy('cot.idcotizacion','desc')
            ->groupBy('cot.idcotizacion','cot.created_at','cte.nomcte','cte.empresa','cot.estado')
            ->paginate(5);
            return view('cotizaciones.index',["cotizaciones"=>$cotizaciones,"searchText"=>$query]);
        }
    }

    public function create(){
            $clientes=DB::table('clientes')->get();
            $productos=DB::table('productos as prod')
                ->select(DB::raw('CONCAT(prod.modelo, " ",prod.nomprod) as producto'),'prod.idprod')
                ->get();
            return view('cotizaciones.create',["clientes"=>$clientes,"productos"=>$productos]);
        }

    public function store(CotizacionFormRequest $request){
        try{
            DB::beginTransaction();
            $cotizacion=new Cotizacion;
            $cotizacion->idcte=$request->get('idcte');
            $cotizacion->estado='Vigente';
            $cotizacion->save();

            $idproducto=$request->get('idprod');
            $cantidad=$request->get('cantidad');
            $precio=$request->get('precio');
            

            $cont=0;

            while ($cont < count($idproducto)) {
                $detalle= new Detallecot();
                $detalle->idcotizacion=$cotizacion->idcotizacion;
                $detalle->idprod=$idproducto[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio=$precio[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();

        }catch(\Exception $e)
        {
            DB::rollback();
        }

        return Redirect::to('cotizaciones');
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
        return view("cotizaciones.show",["cotizacion"=>$cotizacion,"detalles"=>$detalles]);
    }

    public function destroy($id){
        $cotizacion= Cotizacion::findOrFail($id);
        $cotizacion->estado='Descartada';
        $cotizacion->update();
        return Redirect::to('cotizaciones');
    }
}
