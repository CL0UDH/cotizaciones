@extends ('layouts.admin')
@section ('contenido')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Detalle de cotización
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Inicio</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Detalle de cotización
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de cotizaciones <a href="{{url('detallecot/create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('detallecot.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Folio</th>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Importe</th>
					<th>Opciones</th>
				</thead>
				@foreach ($detallecot as $dtc)
				<tr>
					<td>{{$dtc->idcotizacion}}</td>
					<td>{{$dtc->nomprod}}</td>
					<td>{{$dtc->cantidad}}</td>
					<td>{{$dtc->importe}}</td>
					<td>
						<a href="{{URL::action('DetallecotController@edit',$dtc->iddetalle)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$dtc->iddetalle}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('detallecot.modal')
				@endforeach
			</table>
		</div>
		{{$detallecot->render()}}
	</div>
</div>
@endsection