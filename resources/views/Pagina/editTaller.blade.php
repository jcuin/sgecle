@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updateTaller')}}" id="registrar_taller" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="resumen_propuestas" id="resumen_propuestas" value='' hidden="hidden">
	<input type="text" name="resumen_iguales" id="resumen_iguales" value='' hidden="hidden">
	<input type="text" name="resumen_borrados" id="resumen_borrados" value='' hidden="hidden">
	<input type="text" name="resumen_nuevas_propuestas" id="resumen_nuevas_propuestas" value='' hidden="hidden">
	<input type="text" name="id_pagina" value="{{ $id }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro de Taller</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Taller
			</h3> 
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-taller'>
						<tr>
							<td>
								<label for="taller_encabezado">
								Encabezado de Talleres
								<input type="text" name="taller_encabezado"  class="form-control" placeholder="Encabezado de Talleres" value="{{ $pagina -> taller_encabezado }}" style="width: 200px;">
								{{ $errors -> first('taller_encabezado') }}
								</label>						
							</td>
						</tr>
						@if(count($pagina_taller) >= 1)	
							@for($i = 0; $i < count($pagina_taller); $i++)
								<tr id="taller">
									<td>
										@if($i>0)
											<button class="delete_taller pull-right" id="borrado-{{ $pagina_taller[$i] -> id }}" style="background-color: #20193D; color: white">X</button>
										@endif
										<label for="talleres_imagen">
											Imagen del Taller
											<img width="130px" src="{{ Storage::url($pagina_taller[$i] -> talleres_imagen) }}">
											<input type="file" name="talleres_imagen[]" id="{{ $pagina_taller[$i] -> id }}" accept="image/*">
											{{ $errors -> first('talleres_imagen[]') }}
										</label>
										<input type="text" name="id_oculto[]" value="{{ $pagina_taller[$i] -> id }}" hidden="hidden">
										<label for="taller_titulo">
											Título del Taller
											<input type="text" name="talleres_titulo[]"  class="form-control" placeholder="Título del Taller" value="{{ $pagina_taller[$i] -> talleres_titulo }}" style="width: 200px;">
											{{ $errors -> first('talleres_titulo[]') }}
										</label>
										<label for="taller_texto">
											Texto del Taller
											<input type="text" name="talleres_texto[]"  class="form-control" placeholder="Texto del Taller" value="{{ $pagina_taller[$i] -> talleres_texto }}" style="width: 200px;">
											{{ $errors -> first('talleres_texto[]') }}
										</label>						
									</td>
								</tr>
								@endfor
								<tr id="taller" style="display: none;">
									<td>
										<button class="delete_taller_nuevos pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
										<label for="taller_imagen">
											Imagen del Taller
											<input type="text" name="taller_oculto[]" id="taller_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="talleres_nueva_imagen_0" value="0" accept="image/*" class="nueva_imagen">
											{{ $errors -> first('talleres_nueva_imagen[]') }}
										</label>
										<label for="taller_titulo">
											Título del Taller
											<input type="text" name="talleres_nuevo_titulo[]"  class="form-control" placeholder="Título del Taller" style="width: 200px;">
											{{ $errors -> first('talleres_nuevo_titulo[]') }}
										</label>
										<label for="taller_texto">
											Texto del Taller
											<input type="text" name="talleres_nuevo_texto[]"  class="form-control" placeholder="Texto del Taller" style="width: 200px;">
											{{ $errors -> first('talleres_nuevo_texto[]') }}
										</label>						
									</td>
								</tr>
							@endif
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_taller" class="btn btn-primary">Agregar taller</a>
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
		$('#boton_taller').click(function() {
			var $tableBody = $('.tabla-taller').find("tbody"),
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.removeAttr("style");
			$trNew.prop('required',true);
			$trNew.find(".nueva_imagen").attr("name", 'talleres_nueva_imagen_'+(Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").attr("id", (Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").prop("required", true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_taller_nuevos").show();
			$trNew.find(".delete_taller_nuevos").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_taller').click(function(event) {
			event.preventDefault();
			valor = $('#resumen_borrados').attr('value');
			var str = this.id;
			var str_split = str.split('-');
			valor = valor+str_split[1]+'-';
			$('#resumen_borrados').attr('value', valor);
		  	$(this).closest('tr').remove();
		});
		$('.delete_taller_nuevos').click(function(event) {
			event.preventDefault();
		  	$(this).closest('tr').remove();
		});
		$('#registrar_taller').submit(function() {
			valor = '';
			valor_iguales = '';
			$("input[name='talleres_imagen[]']").each( function(){
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