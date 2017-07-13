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
                <i class="fa fa-file"></i> <a href="{{url('productos')}}">Productos</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Editar producto
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar producto: {{$producto->nomprod}}</h3>
		@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		{!!Form::model($producto,['method'=>'PATCH','route'=>['productos.update',$producto->idprod]])!!}
		{{Form::token()}}
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" class="form-control" value="{{$producto->nomprod}}" placeholder="Nombre">
		</div>
		<div class="form-group">
			<label for="precio">Precio</label>
			<input type="text" name="precio" class="form-control" value="{{$producto->precio}}" placeholder="Precio">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection