@extends ('layouts.admin')
@section ('contenido')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Clientes
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="glyphicon fa-fw glyphicon-user"></i> <a href="{{url('clientes')}}">Clientes</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Nuevo Cliente
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nuevo cliente</h3>
		@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		{!!Form::open(array('url'=>'clientes','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!}
		{{Form::token()}}
		<div class="form-group">
			<label for="empresa">Empresa</label>
			<input type="text" name="empresa" class="form-control" placeholder="Empresa">
		</div>
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" class="form-control" placeholder="Nombre">
		</div>					
		<div class="form-group">
			<label for="domicilio">Domicilio</label>
			<input type="text" name="domicilio" class="form-control" placeholder="Aleman 203, Col. Las Fuentes, Celaya, Gto.">
		</div>
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input type="text" name="telefono" class="form-control" placeholder="(461) 111 2222">
		</div>
        <div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" placeholder="example@email.com">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection