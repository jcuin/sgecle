@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updatePropuesta')}}" id="registrar_propuesta" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="resumen_propuestas" id="resumen_propuestas" value='' hidden="hidden">
	<input type="text" name="resumen_iguales" id="resumen_iguales" value='' hidden="hidden">
	<input type="text" name="resumen_borrados" id="resumen_borrados" value='' hidden="hidden">
	<input type="text" name="resumen_nuevas_propuestas" id="resumen_nuevas_propuestas" value='' hidden="hidden">
	<input type="text" name="id_planeacion" value="{{ $id_planeacion }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro de Propuestas</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Propuesta
			</h3> 
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-propuesta'>
						@if(count($propuestas) >= 1)	
							@for($i = 0; $i < count($propuestas); $i++)
								<tr id="propuesta">
									<td>
										@if($i>0)
											<button class="delete_propuesta pull-right" id="borrado-{{ $propuestas[$i] -> id_propuesta }}" style="background-color: #20193D; color: white">X</button>
										@endif
										<?php 
											$archivo = explode('/',Storage::url($propuestas[$i] -> archivo));
											$archivo = end($archivo);
										?>
										Archivo Actual: <b>{{ $archivo }}</b>
										<br>
										<a href="{{ route('downloadFile', $propuestas[$i] -> id_propuesta.'-3') }}" class="btn btn-primary">Descargar</a>
					                	<br><br>
										<label for="propuesta_archivo">
											Archivo
											<input type="text" name="propuesta_oculto[]" id="propuesta_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="propuesta_archivo[]" id="{{ $propuestas[$i] -> id_propuesta }}">
											<span class="help-block">
												{{ $errors -> first('propuesta_archivo[]') }}
											</span>
										</label>
										<input type="text" name="id_oculto[]" value="{{ $propuestas[$i] -> id_propuesta }}" hidden="hidden">
										<label for="fecha_de_uso">
											Fecha de Utilización
											<input type="date" name="fecha_de_uso[]" id="fecha_de_uso" class="form-control" min="{{ date("Y-m-d") }}" value="{{ $propuestas[$i] -> fecha_de_uso }}">
											<span class="help-block">
												{{ $errors -> first('fecha_de_uso[]') }}
											</span>
										</label>
										<br>
										<label for="detalles">
											Observaciones
											<textarea name="detalles[]" id="detalles" class="form-control" rows="4" cols="50" placeholder="Observaciones de la propuesta...">{{ $propuestas[$i] -> detalles }}</textarea>
											<span class="help-block">
												{{ $errors -> first('detalles[]') }}
											</span>
										</label>					
									</td>
								</tr>
								@endfor
								<tr id="propuesta" style="display: none;">
									<td>
										<button class="delete_propuesta_nuevos pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
										<label for="propuesta_nuevo_archivo">
											Archivo de la Propuesta
											<input type="text" name="propuesta_oculto[]" id="propuesta_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="propuesta_nuevo_archivo[]" class="nuevo_propuesta">
											<span class="help-block">
												{{ $errors -> first('propuesta_nuevo_archivo[]') }}
											</span>
										</label>
										<label for="propuesta_nueva_fecha_uso">
											Fecha de Utilización
											<input type="date" name="propuesta_nuevo_fecha_uso[]" id="nuevo_fecha_uso" class="form-control" min="{{ date("Y-m-d") }}">
											<span class="help-block">
												{{ $errors -> first('propuesta_nuevo_fecha_uso[]') }}
											</span>
										</label>
										<br>
										<label for="propuesta_nuevos_detalles">
											Observaciones
											<textarea name="propuesta_nuevos_detalles[]" id="propuesta_nuevos_detalles" class="form-control" rows="4" cols="50" placeholder="Observaciones de la propuesta..."></textarea>
											<span class="help-block">
												{{ $errors -> first('propuesta_nuevos_detalles[]') }}
											</span>
										</label>						
									</td>
								</tr>
							@endif
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_propuesta" class="btn btn-primary">Agregar Propuesta</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Planeacion.show', $id_planeacion) }}" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	$(function(){
    	////////logica onload
		$('#boton_propuesta').click(function() {
			var $tableBody = $('.tabla-propuesta').find("tbody"),
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.removeAttr("style");
			$trNew.prop('required',true);
			$trNew.find(".nuevo_propuesta").attr("name", 'propuesta_nuevo_archivo_'+(Number($auxvalor)+1));
			$trNew.find(".nuevo_propuesta").attr("id", (Number($auxvalor)+1));
			$trNew.find(".nuevo_propuesta").prop("required", true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_propuesta_nuevos").show();
			$trNew.find(".delete_propuesta_nuevos").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_propuesta').click(function(event) {
			event.preventDefault();
			valor = $('#resumen_borrados').attr('value');
			var str = this.id;
			var str_split = str.split('-');
			valor = valor+str_split[1]+'-';
			$('#resumen_borrados').attr('value', valor);
		  	$(this).closest('tr').remove();
		});
		$('.delete_propuesta_nuevos').click(function(event) {
			event.preventDefault();
		  	$(this).closest('tr').remove();
		});
		$('#registrar_propuesta').submit(function() {
			valor = '';
			valor_iguales = '';
			$("input[name='propuesta_archivo[]']").each( function(){
		  		if(this.value !== ''){
		  			valor = valor+this.id+'-';
		  			$('#resumen_propuestas').attr('value', valor);
		  		}else{
		  			valor_iguales = valor_iguales+this.id+'-'
		  			$('#resumen_iguales').attr('value', valor_iguales);
		  		}
		 	});
		 	$(".nuevo_propuesta").each( function(){
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