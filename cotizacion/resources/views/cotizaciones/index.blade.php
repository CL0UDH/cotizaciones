@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de cotizaciones <a href="{{url('cotizaciones/create')}}"><button class="btn btn-success">Nueva</button></a></h3>
		@include('cotizaciones.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Folio</th>
					<th>Empresa</th>
					<th>Contacto</th>
					<th>Fecha</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach ($cotizaciones as $cot)
				<tr>
					<td>{{$cot->idcotizacion}}</td>
					<td>{{$cot->empresa}}</td>
					<td>{{$cot->nomcte}}</td>
					<td>{{$cot->created_at}}</td>
					<td>{{$cot->total}}</td>
					<td>{{$cot->estado}}</td>
					<td>
						<a href="{{URL::action('CotizacionController@show',$cot->idcotizacion)}}"><button class="btn btn-primary">Detalles</button></a>
						<a href="" data-target="#modal-delete-{{$cot->idcotizacion}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('cotizaciones.modal')
				@endforeach
			</table>
		</div>
		{{$cotizaciones->render()}}
	</div>
</div>
@endsection