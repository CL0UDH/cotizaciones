@extends ('layouts.admin')
@section ('contenido')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Productos
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="glyphicon fa-fw glyphicon-tag"></i> <a href="{{url('productos')}}">Productos</a>
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
			<label for="modelo">Marca/Modelo</label>
			<input type="text" name="modelo" class="form-control" value="{{$producto->modelo}}" placeholder="Marca/Modelo">
		</div>
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" class="form-control" value="{{$producto->nomprod}}" placeholder="Nombre">
		</div>
		<div class="form-group">
			<label for="imagen">URL de la imagen</label>
			<input type="text" name="imagen" class="form-control" value="{{$producto->imagen}}" placeholder="Imagen">
		</div>
		<div class="form-group">
			<label for="ficha_tec">URL de la ficha técnica</label>
			<input type="text" name="ficha_tec" class="form-control" value="{{$producto->ficha_tec}}" placeholder="Ficha técnica">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection