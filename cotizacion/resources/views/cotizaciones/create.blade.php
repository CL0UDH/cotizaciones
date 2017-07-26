@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nueva cotización</h3>
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
	
	{!!Form::open(array('url'=>'cotizaciones','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
	<div class="row">
		<vid class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="Contacto">Contacto de la empresa</label>
				<select name="idcte" id="idcte" class="form-control selectpicker" data-live-search="true">
					@foreach($clientes as $cliente)
					<option value="{{$cliente->idcte}}">{{$cliente->nomcte}}</option>
					@endforeach
				</select>
			</div>
		</vid>
	</div>
	<div class="row">	
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label>Producto</label>
						<select name="pidprod" class="form-control selectpicker" id="pidprod" data-live-search="true">
							@foreach($productos as $producto)
							<option value="{{$producto->idprod}}">{{$producto->producto}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<vid class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
					</div>
				</vid>
				<vid class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="precio">Precio</label>
						<input type="number" name="pprecio" id="pprecio" class="form-control" placeholder="Precio">
					</div>
				</vid>
				<vid class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
					</div>
				</vid>
				<vid class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color: #A9D0F5">
							<th>Opciones</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Subtotal</th>
						</thead>
						<tfoot>
							<th>Total</th>
							<th></th>
							<th></th>
							<th></th>
							<th><h4 id="total">$ 0.00</h4></th>
						</tfoot>
						<tbody>
							
						</tbody>	
					</table>
				</vid>
			</div>
		</div>
		<vid class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
			<div class="form-group">
				<input name="_token" value="{{ csrf_token() }}" type="hidden">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</vid>	
	</div>
	{!!Form::close()!!}
@push('scripts')
<script>
	$(document).ready(function() {
		$('#bt_add').click(function(){
			agregar();
		});	
	});

	var cont=0;
	total=0;
	subtotal=[];
	$("#guardar").hide();

	function agregar(){
		idprod=$("#pidprod").val();
		producto=$("#pidprod option:selected").text();
		cantidad=$("#pcantidad").val();
		precio=$("#pprecio").val();

		if(idprod!="" && cantidad!="" && cantidad>0 && precio!=""){
			subtotal[cont]=(cantidad*precio);
			total=total+subtotal[cont];

			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idprod[]" value="'+idprod+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio[]" value="'+precio+'"></td><td>'+subtotal[cont]+'</td></tr>';
			cont++;
			limpiar();
			$("#total").html("S/. "+total);
			evaluar();
			$('#detalles').append(fila);
		}
		else{
			alert("Error al ingresar el detalle del ingreso, revise los datos del artículo");
		}
	}
	
	function limpiar(){
		$("#pcantidad").val("");
		$("#pprecio").val("");
	}

	function evaluar(){
		if(total>0){
			$("#guardar").show();
		}
		else{
			$("#guardar").hide(); 
		}
	}

	function eliminar(index){
		total=total-subtotal[index];
		$("#total").html("S/. "+total);
		$("#fila" + index).remove();
		evaluar();
	}
</script>
@endpush
@endsection
