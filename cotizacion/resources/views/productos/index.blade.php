@extends ('layouts.admin')
@section ('contenido')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Productos
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Inicio</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Productos
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de productos <a href="{{url('productos/create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('productos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Marca/Modelo</th>
					<th>Producto/Descripción</th>
					<th>Imagen</th>
					<th>Ficha técnica</th>
					<th>Opciones</th>
				</thead>
				@foreach ($productos as $prod)
				<tr>
					<td>{{$prod->idprod}}</td>
					<td>{{$prod->modelo}}</td>
					<td height="100px" width="400px">{{$prod->nomprod}}</td>
					<td><img src="{{$prod->imagen}}" alt="imagen" height="100px" width="100px" class="img-thumbnail"></td>
					<td><a href="{{$prod->ficha_tec}}" target="_blank"><button class="btn btn-warning">Ver</button></a></td>
					<td>
						<a href="{{URL::action('ProductoController@edit',$prod->idprod)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$prod->idprod}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('productos.modal')
				@endforeach
			</table>
		</div>
		{{$productos->render()}}
	</div>
</div>
@endsection