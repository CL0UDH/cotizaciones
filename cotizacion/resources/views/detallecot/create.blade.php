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
                <i class="fa fa-file"></i> <a href="{{url('detallecot')}}">Detalle de cotización</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Agregar producto a cotización
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Agregar producto</h3>
		@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
	

<vid class="row">
	<div class="row">
		<vid class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Producto <a href="{{url('productos/create')}}"><button class="btn btn-success btn-xs">Nuevo</button></a></label>
				{!!Form::open(array('url'=>'detallecot','method'=>'POST','autocomplete'=>'off'))!!}
				{{Form::token()}}
				<select name="idprod" class="form-control">
					@foreach ($productos as $prod)
						<option value="{{$prod->idprod}}">{{$prod->nomprod}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="cantidad">Cantidad</label>
				<input type="text" name="cantidad" class="form-control" placeholder="cantidad">
			</div>
			<div class="form-group">
				<label>Folio</label>
				<select name="idcotizacion" class="form-control">
					@foreach ($cotizaciones as $cot)
						<option value="{{$cot->idcotizacion}}">{{$cot->idcotizacion}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</vid>
	</div>
</vid>
{!!Form::close()!!}
@endsection