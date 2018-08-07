@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updateInstalacion')}}" id="registrar_instalacion" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="resumen_propuestas" id="resumen_propuestas" value='' hidden="hidden">
	<input type="text" name="resumen_iguales" id="resumen_iguales" value='' hidden="hidden">
	<input type="text" name="resumen_borrados" id="resumen_borrados" value='' hidden="hidden">
	<input type="text" name="resumen_nuevas_propuestas" id="resumen_nuevas_propuestas" value='' hidden="hidden">
	<input type="text" name="id_pagina" value="{{ $id }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro de Instalaciones</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Instalaciones
			</h3> 
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-instalacion'>
						<tr>
							<td>
								<label for="instalaciones_titulo">
								Título de Instalaciones
								<input type="text" name="instalaciones_titulo"  class="form-control" placeholder="Encabezado de las Instalaciones" value="{{ $pagina -> instalaciones_titulo }}" style="width: 200px;">
								{{ $errors -> first('instalaciones_titulo') }}
								</label>
								<label for="instalaciones_texto">
								Texto de Instalaciones
								<input type="text" name="instalaciones_texto"  class="form-control" placeholder="Texto de las Instalaciones" value="{{ $pagina -> instalaciones_texto }}" style="width: 200px;">
								{{ $errors -> first('instalaciones_texto') }}
								</label>						
							</td>
						</tr>
						@if(count($pagina_instalacion) >= 1)	
							@for($i = 0; $i < count($pagina_instalacion); $i++)
								<tr id="instalacion">
									<td>
										@if($i>0)
											<button class="delete_instalacion pull-right" id="borrado-{{ $pagina_instalacion[$i] -> id }}" style="background-color: #20193D; color: white">X</button>
										@endif
										<label for="instalaciones_imagen">
											Imagen de la Instalación
											<img width="130px" src="{{ Storage::url($pagina_instalacion[$i] -> instalaciones_imagen) }}">
											<input type="file" name="instalaciones_imagen[]" id="{{ $pagina_instalacion[$i] -> id }}" accept="image/*">
											{{ $errors -> first('instalaciones_imagen[]') }}
										</label>
										<input type="text" name="id_oculto[]" value="{{ $pagina_instalacion[$i] -> id }}" hidden="hidden">
										<label for="instalaciones_titulo_imagen">
											Título de la Instalación
											<input type="text" name="instalaciones_titulo_imagen[]"  class="form-control" placeholder="Título del la Instalación" value="{{ $pagina_instalacion[$i] -> instalaciones_titulo_imagen }}" style="width: 200px;">
											{{ $errors -> first('instalaciones_titulo_imagen[]') }}
										</label>
										<label for="instalaciones_texto_imagen">
											Texto de la Instalación
											<input type="text" name="instalaciones_texto_imagen[]"  class="form-control" placeholder="Texto de la Instalación" value="{{ $pagina_instalacion[$i] -> instalaciones_texto_imagen }}" style="width: 200px;">
											{{ $errors -> first('instalaciones_texto_imagen[]') }}
										</label>						
									</td>
								</tr>
								@endfor
								<tr id="instalacion" style="display: none;">
									<td>
										<button class="delete_instalacion_nuevos pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
										<label for="instalacion_imagen">
											Imagen de la Instalación
											<input type="text" name="instalacion_oculto[]" id="instalacion_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="instalaciones_nueva_imagen_0" value="0" accept="image/*" class="nueva_imagen">
											{{ $errors -> first('instalaciones_nueva_imagen[]') }}
										</label>
										<label for="instalacion_titulo">
											Título de la Instalación
											<input type="text" name="instalaciones_nuevo_titulo_imagen[]"  class="form-control" placeholder="Título de la Instalación" style="width: 200px;">
											{{ $errors -> first('instalaciones_nuevo_titulo_imagen[]') }}
										</label>
										<label for="instalacion_texto">
											Texto de la Instalación
											<input type="text" name="instalaciones_nuevo_texto_imagen[]"  class="form-control" placeholder="Texto de la Instalación" style="width: 200px;">
											{{ $errors -> first('instalaciones_nuevo_texto_imagen[]') }}
										</label>						
									</td>
								</tr>
							@endif
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_instalacion" class="btn btn-primary">Agregar Instalación</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Pagina.show', $id) }}" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	$(function(){
    	////////logica onload
		$('#boton_instalacion').click(function() {
			var $tableBody = $('.tabla-instalacion').find("tbody"),
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.removeAttr("style");
			$trNew.prop('required',true);
			$trNew.find(".nueva_imagen").attr("name", 'instalaciones_nueva_imagen_'+(Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").attr("id", (Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").prop("required", true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_instalacion_nuevos").show();
			$trNew.find(".delete_instalacion_nuevos").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_instalacion').click(function(event) {
			event.preventDefault();
			valor = $('#resumen_borrados').attr('value');
			var str = this.id;
			var str_split = str.split('-');
			valor = valor+str_split[1]+'-';
			$('#resumen_borrados').attr('value', valor);
		  	$(this).closest('tr').remove();
		});
		$('.delete_instalacion_nuevos').click(function(event) {
			event.preventDefault();
		  	$(this).closest('tr').remove();
		});
		$('#registrar_instalacion').submit(function() {
			valor = '';
			valor_iguales = '';
			$("input[name='instalaciones_imagen[]']").each( function(){
		  		if(this.value !== ''){
		  			valor = valor+this.id+'-';
		  			$('#resumen_propuestas').attr('value', valor);
		  		}else{
		  			valor_iguales = valor_iguales+this.id+'-'
		  			$('#resumen_iguales').attr('value', valor_iguales);
		  		}
		 	});
		 	$(".nueva_imagen").each( function(){
		  		valor_nuevo = '';
		  		if(this.value !== ''){
		  			valor_nuevo = valor_nuevo+this.id+'-';
		  			$('#resumen_nuevas_propuestas').attr('value', valor_nuevo);
		  		}
		 	});
		  	return true;
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
	tr:nth-child(even) {background: #CCC}
	tr:nth-child(odd) {background: #FFF}
</style>
@endsection