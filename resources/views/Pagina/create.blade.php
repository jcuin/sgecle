@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Pagina.store')}}" enctype="multipart/form-data">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Página</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Banner Principal 
			</h3>
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-pagina'>
						<tr>
							<td>
								<label for="descripcion">
									Descripción
									<input type="text" name="descripcion" value="{{old('descripcion')}}" placeholder="Descripción de la configuración">
									{{ $errors -> first('descripcion') }}
								</label>
							</td>
						</tr>
						<tr  id="banner_imagen">
							<td>
								<label for="banner_principal_imagen">
									Imagen del Banner
									<input type="file" name="banner_principal_imagen" value="{{old('banner_principal_imagen')}}" accept="image/*" required="required">
									{{ $errors -> first('banner_principal_imagen') }}
								</label>
							</td>
						</tr>
						<tr id="banner_texto">
							<td>
								<button class="delete_texto_banner pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
								<input type="text" name="banner_principal_oculto[]" id="banner_principal_oculto" class="oculto" value="0" hidden="hidden">
								<label for="banner_principal_texto">
									Texto del Banner Principal
									<input type="text" name="banner_principal_texto[]"  class="form-control" placeholder="Texto Transición" style="width: 200px;" required="required">
									{{ $errors -> first('banner_principal_texto[]') }}
								</label>						
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_banner" class="btn btn-primary">Agregar Texto del Banner</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<h3 align="center">
				Oferta Educativa
			</h3> 
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-oferta'>
						<tr id="oferta">
							<td>
								<button class="delete_oferta pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
								<input type="text" name="oferta_oculto[]" id="oferta_oculto" class="oculto" value="0" hidden="hidden">
								<label for="oferta_imagen">
									Imagen de la Oferta
									<input type="file" name="oferta_imagen[]" value="{{old('oferta_imagen')}}" accept="image/*" required="required">
									{{ $errors -> first('oferta_imagen[]') }}
								</label>
								<label for="oferta_titulo">
									Título de la Oferta
									<input type="text" name="oferta_titulo[]"  class="form-control" placeholder="Título de la Oferta" style="width: 200px;">
									{{ $errors -> first('oferta_titulo[]') }}
								</label>
								<label for="oferta_texto">
									Texto de la Oferta
									<input type="text" name="oferta_texto[]"  class="form-control" placeholder="Texto de la Oferta" style="width: 200px;">
									{{ $errors -> first('oferta_texto[]') }}
								</label>						
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_oferta" class="btn btn-primary">Agregar Oferta</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<h3 align="center">
				Talleres
			</h3>
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-taller'>
						<tr id="taller_encabezado">
							<td>
								<label for="taller_encabezado">
									Encabezado de Talleres
									<input type="text" name="taller_encabezado"  class="form-control" placeholder="Encabezado de Talleres" style="width: 200px;">
									{{ $errors -> first('taller_encabezado') }}
								</label>						
							</td>
						</tr>
						<tr id="taller">
							<td>
								<button class="delete_taller pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
								<input type="text" name="taller_oculto[]" id="taller_oculto" class="oculto" value="0" hidden="hidden">
								<label for="taller_imagen">
									Imagen del Taller
									<input type="file" name="talleres_imagen[]" value="{{old('taller_imagen')}}" accept="image/*" required="required">
									{{ $errors -> first('taller_imagen[]') }}
								</label>
								<label for="taller_titulo">
									Título del Taller
									<input type="text" name="talleres_titulo[]"  class="form-control" placeholder="Título del Taller" style="width: 200px;">
									{{ $errors -> first('taller_titulo[]') }}
								</label>
								<label for="taller_texto">
									Texto del Taller
									<input type="text" name="talleres_texto[]"  class="form-control" placeholder="Texto del Taller" style="width: 200px;">
									{{ $errors -> first('taller_texto[]') }}
								</label>						
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_taller" class="btn btn-primary">Agregar Taller</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<h3 align="center">
				Instalaciones
			</h3>
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-instalaciones'>
						<tr id="instalaciones_titulo_texto">
							<td>
								<label for="instalaciones_titulo">
									Título de las Instalaciones
									<input type="text" name="instalaciones_titulo"  class="form-control" placeholder="Título de las Instalaciones" style="width: 200px;">
									{{ $errors -> first('instalaciones_titulo') }}
								</label>
								<label for="instalaciones_texto">
									Texto de las Instalaciones
									<input type="text" name="instalaciones_texto"  class="form-control" placeholder="Texto de las Instalaciones" style="width: 200px;">
									{{ $errors -> first('instalaciones_texto') }}
								</label>						
							</td>
						</tr>
						<tr id="instalaciones">
							<td>
								<button class="delete_instalaciones pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
								<input type="text" name="instalaciones_oculto[]" id="instalaciones_oculto" class="oculto" value="0" hidden="hidden">
								<label for="instalaciones_imagen">
									Imagen de las Instalaciones
									<input type="file" name="instalaciones_imagen[]" value="{{old('instalaciones_imagen')}}" accept="image/*" required="required">
									{{ $errors -> first('instalaciones_imagen[]') }}
								</label>
								<label for="instalaciones_titulo">
									Título de la Imagen
									<input type="text" name="instalaciones_titulo_imagen[]"  class="form-control" placeholder="Título de la Imagen" style="width: 200px;">
									{{ $errors -> first('instalaciones_titulo_imagen[]') }}
								</label>
								<label for="instalaciones_texto">
									Texto de la Imagen
									<input type="text" name="instalaciones_texto_imagen[]"  class="form-control" placeholder="Texto de la Imagen" style="width: 200px;">
									{{ $errors -> first('instalaciones_texto_imagen[]') }}
								</label>						
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_instalaciones" class="btn btn-primary">Agregar Instalaciones</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<h3 align="center">
				Horario Extendido
			</h3>
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-horario_extendido'>
						<tr id="horarioExt_titulo_texto">
							<td>
								<label for="horarioExt_titulo">
									Título de la Actividad
									<input type="text" name="horario_titulo"  class="form-control" placeholder="Título de la Actividad" style="width: 200px;">
									{{ $errors -> first('horario_titulo') }}
								</label>
								<label for="horarioExt_texto">
									Texto de la Actividad
									<input type="text" name="horario_texto"  class="form-control" placeholder="Texto de la Actividad" style="width: 200px;">
									{{ $errors -> first('horario_texto') }}
								</label>						
							</td>
						</tr>
						<tr id="horario">
							<td>
								<button class="delete_horario pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
								<input type="text" name="horario_oculto[]" id="horario_oculto" class="oculto" value="0" hidden="hidden">
								<label for="horario_imagen">
									Imagen de las horario
									<input type="file" name="horario_imagen[]" value="{{old('horario_imagen')}}" accept="image/*" required="required">
									{{ $errors -> first('horario_imagen[]') }}
								</label>
								<label for="horario_titulo_imagen">
									Título de la Imagen
									<input type="text" name="horario_titulo_imagen[]"  class="form-control" placeholder="Título de la Imagen" style="width: 200px;">
									{{ $errors -> first('horario_titulo_imagen[]') }}
								</label>
								<label for="horario_texto_imagen">
									Texto de la Imagen
									<input type="text" name="horario_texto_imagen[]"  class="form-control" placeholder="Texto de la imagen" style="width: 200px;">
									{{ $errors -> first('horario_texto_imagen[]') }}
								</label>						
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_horario_extendido" class="btn btn-primary">Agregar Horario</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<h3 align="center">
				Convenios
			</h3>
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-convenios'>
						<tr id="convenio">
							<td>
								<button class="delete_convenio pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
								<input type="text" name="convenio_oculto[]" id="convenio_oculto" class="oculto" value="0" hidden="hidden">
								<label for="convenio_imagen">
									Imagen del Convenio
									<input type="file" name="convenio_imagen[]" style="width: 200px;" accept="image/*" required="required">
									{{ $errors -> first('convenio_imagen[]') }}
								</label>
								<label for="convenio_titulo">
									Título del Convenio
									<input type="text" name="convenio_titulo[]"  class="form-control" placeholder="Título del Convenio" style="width: 200px;">
									{{ $errors -> first('convenio_titulo[]') }}
								</label>						
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_convenio" class="btn btn-primary">Agregar Convenio</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Pagina.index') }}" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	$(function(){
    	////////logica onload
   		$('#boton_banner').click(function() {
			var $tableBody = $('.tabla-pagina').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_texto_banner").show();
			$trNew.find(".delete_texto_banner").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('#boton_oferta').click(function() {
			var $tableBody = $('.tabla-oferta').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_oferta").show();
			$trNew.find(".delete_oferta").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('#boton_taller').click(function() {
			var $tableBody = $('.tabla-taller').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_taller").show();
			$trNew.find(".delete_taller").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('#boton_instalaciones').click(function() {
			var $tableBody = $('.tabla-instalaciones').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_instalaciones").show();
			$trNew.find(".delete_instalaciones").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('#boton_horario_extendido').click(function() {
			var $tableBody = $('.tabla-horario_extendido').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_horario").show();
			$trNew.find(".delete_horario").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('#boton_convenio').click(function() {
			var $tableBody = $('.tabla-convenios').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_convenio").show();
			$trNew.find(".delete_convenio").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_texto_banner').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
		$('.delete_oferta').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
		$('.delete_taller').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
		$('.delete_instalaciones').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
		$('.delete_horario').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
		$('.delete_convenio').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
	});
</script>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="text"] {
    	width: 300px;
	}
</style>
@endsection