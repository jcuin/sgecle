@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updateOferta')}}" id="registrar_oferta" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="resumen_propuestas" id="resumen_propuestas" value='' hidden="hidden">
	<input type="text" name="resumen_iguales" id="resumen_iguales" value='' hidden="hidden">
	<input type="text" name="resumen_borrados" id="resumen_borrados" value='' hidden="hidden">
	<input type="text" name="resumen_nuevas_propuestas" id="resumen_nuevas_propuestas" value='' hidden="hidden">
	<input type="text" name="id_pagina" value="{{ $id }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro de Oferta</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Oferta Educativa
			</h3> 
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-oferta'>
						@if(count($pagina_oferta) >= 1)	
							@for($i = 0; $i < count($pagina_oferta); $i++)
								<tr id="oferta">
									<td>
										@if($i>0)
											<button class="delete_oferta pull-right" id="borrado-{{ $pagina_oferta[$i] -> id }}" style="background-color: #20193D; color: white">X</button>
										@endif
										<label for="oferta_imagen">
											Imagen de la Oferta
											<img width="130px" src="{{ Storage::url($pagina_oferta[$i] -> oferta_imagen) }}">
											<input type="file" name="oferta_imagen[]" id="{{ $pagina_oferta[$i] -> id }}" accept="image/*">
											{{ $errors -> first('oferta_imagen[]') }}
										</label>
										<input type="text" name="id_oculto[]" value="{{ $pagina_oferta[$i] -> id }}" hidden="hidden">
										<label for="oferta_titulo">
											Título de la Oferta
											<input type="text" name="oferta_titulo[]"  class="form-control" placeholder="Título de la Oferta" value="{{ $pagina_oferta[$i] -> oferta_titulo }}" style="width: 200px;">
											{{ $errors -> first('oferta_titulo[]') }}
										</label>
										<label for="oferta_texto">
											Texto de la Oferta
											<input type="text" name="oferta_texto[]"  class="form-control" placeholder="Texto de la Oferta" value="{{ $pagina_oferta[$i] -> oferta_texto }}" style="width: 200px;">
											{{ $errors -> first('oferta_texto[]') }}
										</label>						
									</td>
								</tr>
								@endfor
								<tr id="oferta" style="display: none;">
									<td>
										<button class="delete_oferta_nuevos pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
										<label for="oferta_nueva_imagen">
											Imagen de la Oferta
											<input type="text" name="oferta_oculto[]" id="oferta_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="oferta_nueva_imagen_0" value="0" accept="image/*" class="nueva_imagen">
											{{ $errors -> first('oferta_nueva_imagen[]') }}
										</label>
										<label for="oferta_nuevo_titulo">
											Título de la Oferta
											<input type="text" name="oferta_nuevo_titulo[]"  class="form-control" placeholder="Título de la Oferta" style="width: 200px;">
											{{ $errors -> first('oferta_nuevo_titulo[]') }}
										</label>
										<label for="oferta_nuevo_texto">
											Texto de la Oferta
											<input type="text" name="oferta_nuevo_texto[]"  class="form-control" placeholder="Texto de la Oferta" style="width: 200px;">
											{{ $errors -> first('oferta_nuevo_texto[]') }}
										</label>						
									</td>
								</tr>			
							@endif
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_oferta" class="btn btn-primary">Agregar Oferta</a>
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
		$('#boton_oferta').click(function() {
			var $tableBody = $('.tabla-oferta').find("tbody"),
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.removeAttr("style");
			$trNew.prop('required',true);
			$trNew.find(".nueva_imagen").attr("name", 'oferta_nueva_imagen_'+(Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").attr("id", (Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").prop("required", true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_oferta_nuevos").show();
			$trNew.find(".delete_oferta_nuevos").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_oferta').click(function(event) {
			event.preventDefault();
			valor = $('#resumen_borrados').attr('value');
			var str = this.id;
			var str_split = str.split('-');
			valor = valor+str_split[1]+'-';
			$('#resumen_borrados').attr('value', valor);
		  	$(this).closest('tr').remove();
		});
		$('.delete_oferta_nuevos').click(function(event) {
			event.preventDefault();
		  	$(this).closest('tr').remove();
		});
		$('#registrar_oferta').submit(function() {
			valor = '';
			valor_iguales = '';
			$("input[name='oferta_imagen[]']").each( function(){
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