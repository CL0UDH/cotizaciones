<div class="row">
		<vid class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
			<div class="form-group">
				<label for="folio">Folio</label>
				<p>{{$cotizacion->idcotizacion}}</p>
			</div>
		</vid>
		<vid class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
			<div class="form-group">
				<label for="fecha" align="right">Fecha</label>
				<p>{{$cotizacion->created_at}}</p>
			</div>
		</vid>
	</div>
	<div class="row">
		<vid class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
			<div class="form-group">
				<label for="empresa">Empresa</label>
				<p>{{$cotizacion->empresa}}</p>
			</div>
		</vid>
		<vid class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
			<div class="form-group">
				<label for="contacto">Contacto</label>
				<p>{{$cotizacion->nomcte}}</p>
			</div>
		</vid>
	</div>
	<div class="row">
		<vid class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="domicilio">Domicilio</label>
				<p>{{$cotizacion->domicilio}}</p>
			</div>
		</vid>
		<vid class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="telefono">Teléfono</label>
				<p>{{$cotizacion->telefono}}</p>
			</div>
		</vid>
		<vid class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<p>{{$cotizacion->email}}</p>
			</div>
		</vid>
	</div>
	<div class="row">	
		<div class="panel panel-primary">
			<div class="panel-body">
				<vid class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color: #A9D0F5">
							<th>Imagen</th>
							<th>Marca/Modelo</th>
							<th>Producto/Descripción</th>
							<th>Cantidad</th>
							<th>Ficha técnica</th>
							<th>Precio</th>
							<th>Subtotal</th>
						</thead>
						<tfoot>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th>Total</th>
							<th><h4 id="total">${{$cotizacion->total}}</h4></th>
						</tfoot>
						<tbody>
							@foreach($detalles as $det)
							<tr>
								<td><img src="{{$det->imagen}}" alt="imagen" height="100px" width="100px" class="img-thumbnail"></td>
								<td>{{$det->modelo}}</td>
								<td height="100px" width="400px">{{$det->producto}}</td>
								<td>{{$det->cantidad}}</td>
								<td><a href="{{$det->ficha_tec}}" target="_blank"><button class="btn btn-warning">Ver</button></a></td>
								<td>${{$det->precio}}</td>
								<td>${{$det->cantidad*$det->precio}}</td>
							</tr>
							@endforeach
						</tbody>	
					</table>
				</vid>
			</div>
		</div>	
	</div>