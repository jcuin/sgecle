@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updateConvenio')}}" id="registrar_convenio" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="resumen_propuestas" id="resumen_propuestas" value='' hidden="hidden">
	<input type="text" name="resumen_iguales" id="resumen_iguales" value='' hidden="hidden">
	<input type="text" name="resumen_borrados" id="resumen_borrados" value='' hidden="hidden">
	<input type="text" name="resumen_nuevas_propuestas" id="resumen_nuevas_propuestas" value='' hidden="hidden">
	<input type="text" name="id_pagina" value="{{ $id }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro Convenios</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Convenio
			</h3> 
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-convenio'>
						@if(count($pagina_convenio) >= 1)	
							@for($i = 0; $i < count($pagina_convenio); $i++)
								<tr id="oferta">
									<td>
										@if($i>0)
											<button class="delete_convenio pull-right" id="borrado-{{ $pagina_convenio[$i] -> id }}" style="background-color: #20193D; color: white">X</button>
										@endif
										<label for="oferta_imagen">
											Imagen del convenio
											<img width="130px" src="{{ Storage::url($pagina_convenio[$i] -> convenio_imagen) }}">
											<input type="file" name="convenio_imagen[]" id="{{ $pagina_convenio[$i] -> id }}" accept="image/*">
											{{ $errors -> first('convenio_imagen[]') }}
										</label>
										<input type="text" name="id_oculto[]" value="{{ $pagina_convenio[$i] -> id }}" hidden="hidden">
										<label for="convenio_titulo">
											Título del Convenio
											<input type="text" name="convenio_titulo[]"  class="form-control" placeholder="Título del Convenio" value="{{ $pagina_convenio[$i] -> convenio_titulo }}" style="width: 200px;">
											{{ $errors -> first('convenio_titulo[]') }}
										</label>					
									</td>
								</tr>
								@endfor
								<tr id="convenio" style="display: none;">
									<td>
										<button class="delete_convenio_nuevos pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
										<label for="convenio_imagen">
											Imagen del Convenio
											<input type="text" name="convenio_oculto[]" id="convenio_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="convenio_nueva_imagen_0" value="0" accept="image/*" class="nueva_imagen">
											{{ $errors -> first('convenio_nueva_imagen[]') }}
										</label>
										<label for="convenio_nuevo_titulo">
											Título del Convenio
											<input type="text" name="convenio_nuevo_titulo[]"  class="form-control" placeholder="Título del Convenio" style="width: 200px;">
											{{ $errors -> first('convenio_nuevo_titulo[]') }}
										</label>						
									</td>
								</tr>			
							@endif
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_convenio" class="btn btn-primary">Agregar convenio</a>
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
		$('#boton_convenio').click(function() {
			var $tableBody = $('.tabla-convenio').find("tbody"),
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.removeAttr("style");
			$trNew.prop('required',true);
			$trNew.find(".nueva_imagen").attr("name", 'convenio_nueva_imagen_'+(Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").attr("id", (Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").prop("required", true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_convenio_nuevos").show();
			$trNew.find(".delete_convenio_nuevos").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_convenio').click(function(event) {
			event.preventDefault();
			valor = $('#resumen_borrados').attr('value');
			var str = this.id;
			var str_split = str.split('-');
			valor = valor+str_split[1]+'-';
			$('#resumen_borrados').attr('value', valor);
		  	$(this).closest('tr').remove();
		});
		$('.delete_convenio_nuevos').click(function(event) {
			event.preventDefault();
		  	$(this).closest('tr').remove();
		});
		$('#registrar_convenio').submit(function() {
			valor = '';
			valor_iguales = '';
			$("input[name='convenio_imagen[]']").each( function(){
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