@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updateAnexo')}}" id="registrar_anexo" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="resumen_propuestas" id="resumen_propuestas" value='' hidden="hidden">
	<input type="text" name="resumen_iguales" id="resumen_iguales" value='' hidden="hidden">
	<input type="text" name="resumen_borrados" id="resumen_borrados" value='' hidden="hidden">
	<input type="text" name="resumen_nuevas_propuestas" id="resumen_nuevas_propuestas" value='' hidden="hidden">
	<input type="text" name="id_planeacion" value="{{ $id_planeacion }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro de Anexos</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Anexo
			</h3> 
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-anexo'>
						@if(count($anexos) >= 1)	
							@for($i = 0; $i < count($anexos); $i++)
								<tr id="anexo">
									<td>
										@if($i>0)
											<button class="delete_anexo pull-right" id="borrado-{{ $anexos[$i] -> id_anexo }}" style="background-color: #20193D; color: white">X</button>
										@endif
										<?php 
											$archivo = explode('/',Storage::url($anexos[$i] -> archivo));
											$archivo = end($archivo);
										?>
										Archivo Actual: <b>{{ $archivo }}</b>
										<br>
										<a href="{{ route('downloadFile', $anexos[$i] -> id_anexo.'-2') }}" class="btn btn-primary">Descargar</a>
					                	<br><br>
										<label for="anexo_archivo">
											Nuevo Archivo
											<input type="text" name="anexo_oculto[]" id="anexo_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="anexo_archivo[]" id="{{ $anexos[$i] -> id_anexo }}">
											<span class="help-block">
												{{ $errors -> first('anexo_archivo[]') }}
											</span>
										</label>
										<input type="text" name="id_oculto[]" value="{{ $anexos[$i] -> id_anexo }}" hidden="hidden">
										<label for="numero_copias">
											Número de Copias Requeridas(s)
											<input type="number" name="numero_copias[]" class="form-control" placeholder="# de copias" value="{{ $anexos[$i] -> numero_copias }}">
											<span class="help-block">
												{{ $errors -> first('numero_copias[]') }}
											</span>
										</label>
										<label for="fecha_de_uso">
											Fecha de Utilización
											<input type="date" name="fecha_de_uso[]" id="fecha_de_uso" class="form-control" min="{{ date("Y-m-d") }}" value="{{ $anexos[$i] -> fecha_de_uso }}">
											<span class="help-block">
												{{ $errors -> first('fecha_de_uso[]') }}
											</span>
										</label>					
									</td>
								</tr>
								@endfor
								<tr id="anexo" style="display: none;">
									<td>
										<button class="delete_anexo_nuevos pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
										<label for="anexo_nuevo_archivo">
											Archivo del Anexo
											<input type="text" name="anexo_oculto[]" id="anexo_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="anexo_nuevo_archivo[]" class="nuevo_anexo">
											<span class="help-block">
												{{ $errors -> first('anexo_nuevo_archivo[]') }}
											</span>
										</label>
										<label for="anexo_nuevo_numero_copias">
											Número de Copias Requeridas(s)
											<input type="text" name="anexo_nuevo_numero_copias[]"  class="form-control" placeholder="# de copias" style="width: 200px;">
											{{ $errors -> first('anexo_nuevo_numero_copias[]') }}
										</label>
										<label for="anexo_nueva_fecha_uso">
											Fecha de Utilización
											<input type="date" name="anexo_nuevo_fecha_uso[]" id="nuevo_fecha_uso" class="form-control" min="{{ date("Y-m-d") }}">
											<span class="help-block">
												{{ $errors -> first('anexo_nuevo_fecha_uso[]') }}
											</span>
										</label>						
									</td>
								</tr>
							@endif
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_anexo" class="btn btn-primary">Agregar Anexo</a>
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
		$('#boton_anexo').click(function() {
			var $tableBody = $('.tabla-anexo').find("tbody"),
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.removeAttr("style");
			$trNew.prop('required',true);
			$trNew.find(".nuevo_anexo").attr("name", 'anexo_nuevo_archivo_'+(Number($auxvalor)+1));
			$trNew.find(".nuevo_anexo").attr("id", (Number($auxvalor)+1));
			$trNew.find(".nuevo_anexo").prop("required", true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_anexo_nuevos").show();
			$trNew.find(".delete_anexo_nuevos").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_anexo').click(function(event) {
			event.preventDefault();
			valor = $('#resumen_borrados').attr('value');
			var str = this.id;
			var str_split = str.split('-');
			valor = valor+str_split[1]+'-';
			$('#resumen_borrados').attr('value', valor);
		  	$(this).closest('tr').remove();
		});
		$('.delete_anexo_nuevos').click(function(event) {
			event.preventDefault();
		  	$(this).closest('tr').remove();
		});
		$('#registrar_anexo').submit(function() {
			valor = '';
			valor_iguales = '';
			$("input[name='anexo_archivo[]']").each( function(){
		  		if(this.value !== ''){
		  			valor = valor+this.id+'-';
		  			$('#resumen_propuestas').attr('value', valor);
		  		}else{
		  			valor_iguales = valor_iguales+this.id+'-'
		  			$('#resumen_iguales').attr('value', valor_iguales);
		  		}
		 	});
		 	$(".nuevo_anexo").each( function(){
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