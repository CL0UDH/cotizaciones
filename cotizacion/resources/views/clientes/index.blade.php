@extends ('layouts.admin')
@section ('contenido')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Clientes
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Inicio</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Clientes
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de clientes <a href="{{url('clientes/create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('clientes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Domicilio</th>
					<th>Telefono</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
				@foreach ($clientes as $cte)
				<tr>
					<td>{{$cte->idcte}}</td>
					<td>{{$cte->nomcte}}</td>
					<td>{{$cte->domicilio}}</td>
					<td>{{$cte->telefono}}</td>
					<td>{{$cte->email}}</td>
					<td>
						<a href="{{URL::action('ClienteController@edit',$cte->idcte)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cte->idcte}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('clientes.modal')
				@endforeach
			</table>
		</div>
		{{$clientes->render()}}
	</div>
</div>
@endsection