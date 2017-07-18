@extends ('layouts.admin')
@section ('contenido')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Cotizaciones
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Inicio</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> <a href="{{url('cotizaciones')}}">Cotizaciones</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Editar cotizacion
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar cotizacion: {{$cotizacion->idcotizacion}}</h3>
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
				<label>Cliente <a href="{{url('clientes/create')}}"><button class="btn btn-success btn-xs">Nuevo</button></a></label>
				{!!Form::model($cotizacion,['method'=>'PATCH','route'=>['cotizaciones.update',$cotizacion->idcotizacion]])!!}
				{{Form::token()}}
				<select name="idcte" class="form-control">
					@foreach ($clientes as $cte)
						@if($cte->idcte==$cotizacion->idcte)
						<option value="{{$cte->idcte}}" selected>{{$cte->nomcte}}</option>
						@else
						<option value="{{$cte->idcte}}">{{$cte->nomcte}}</option>
						@endif
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