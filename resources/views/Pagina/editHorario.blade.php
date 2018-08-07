@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updateHorario')}}" id="registrar_horario" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="resumen_propuestas" id="resumen_propuestas" value='' hidden="hidden">
	<input type="text" name="resumen_iguales" id="resumen_iguales" value='' hidden="hidden">
	<input type="text" name="resumen_borrados" id="resumen_borrados" value='' hidden="hidden">
	<input type="text" name="resumen_nuevas_propuestas" id="resumen_nuevas_propuestas" value='' hidden="hidden">
	<input type="text" name="id_pagina" value="{{ $id }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro Horarios</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Horario
			</h3> 
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-horario'>
						<tr>
							<td>
								<label for="horario_titulo">
								Título del Horario
								<input type="text" name="horario_titulo"  class="form-control" placeholder="Encabezado del Horario" value="{{ $pagina -> horario_titulo }}" style="width: 200px;">
								{{ $errors -> first('horario_titulo') }}
								</label>
								<label for="horario_texto">
								Texto del Horario
								<input type="text" name="horario_texto"  class="form-control" placeholder="Texto del Horario" value="{{ $pagina -> horario_texto }}" style="width: 200px;">
								{{ $errors -> first('horario_texto') }}
								</label>						
							</td>
						</tr>
						@if(count($pagina_horario) >= 1)	
							@for($i = 0; $i < count($pagina_horario); $i++)
								<tr id="oferta">
									<td>
										@if($i>0)
											<button class="delete_horario pull-right" id="borrado-{{ $pagina_horario[$i] -> id }}" style="background-color: #20193D; color: white">X</button>
										@endif
										<label for="oferta_imagen">
											Imagen del Horario
											<img width="130px" src="{{ Storage::url($pagina_horario[$i] -> horario_imagen) }}">
											<input type="file" name="horario_imagen[]" id="{{ $pagina_horario[$i] -> id }}" accept="image/*">
											{{ $errors -> first('horario_imagen[]') }}
										</label>
										<input type="text" name="id_oculto[]" value="{{ $pagina_horario[$i] -> id }}" hidden="hidden">
										<label for="horario_titulo_imagen">
											Título de la horario
											<input type="text" name="horario_titulo_imagen[]"  class="form-control" placeholder="Título de la horario" value="{{ $pagina_horario[$i] -> horario_titulo_imagen }}" style="width: 200px;">
											{{ $errors -> first('horario_titulo_imagen[]') }}
										</label>
										<label for="horario_texto_imagen">
											Texto de la horario
											<input type="text" name="horario_texto_imagen[]"  class="form-control" placeholder="Texto de la horario" value="{{ $pagina_horario[$i] -> horario_texto_imagen }}" style="width: 200px;">
											{{ $errors -> first('horario_texto_imagen[]') }}
										</label>						
									</td>
								</tr>
								@endfor
								<tr id="horario" style="display: none;">
									<td>
										<button class="delete_horario_nuevos pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
										<label for="horario_imagen">
											Imagen del Horario
											<input type="text" name="horario_oculto[]" id="horario_oculto" class="oculto" value="0" hidden="hidden">
											<input type="file" name="horario_nueva_imagen_0" value="0" accept="image/*" class="nueva_imagen">
											{{ $errors -> first('horario_nueva_imagen[]') }}
										</label>
										<label for="horario_nuevo_titulo_imagen">
											Título del Horario
											<input type="text" name="horario_nuevo_titulo_imagen[]"  class="form-control" placeholder="Título del Horario" style="width: 200px;">
											{{ $errors -> first('horario_nuevo_titulo_imagen[]') }}
										</label>
										<label for="horario_nuevo_texto_imagen">
											Texto del Horario
											<input type="text" name="horario_nuevo_texto_imagen[]"  class="form-control" placeholder="Texto del Horario" style="width: 200px;">
											{{ $errors -> first('horario_nuevo_texto_imagen[]') }}
										</label>						
									</td>
								</tr>			
							@endif
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_horario" class="btn btn-primary">Agregar horario</a>
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
		$('#boton_horario').click(function() {
			var $tableBody = $('.tabla-horario').find("tbody"),
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.removeAttr("style");
			$trNew.prop('required',true);
			$trNew.find(".nueva_imagen").attr("name", 'horario_nueva_imagen_'+(Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").attr("id", (Number($auxvalor)+1));
			$trNew.find(".nueva_imagen").prop("required", true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_horario_nuevos").show();
			$trNew.find(".delete_horario_nuevos").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_horario').click(function(event) {
			event.preventDefault();
			valor = $('#resumen_borrados').attr('value');
			var str = this.id;
			var str_split = str.split('-');
			valor = valor+str_split[1]+'-';
			$('#resumen_borrados').attr('value', valor);
		  	$(this).closest('tr').remove();
		});
		$('.delete_horario_nuevos').click(function(event) {
			event.preventDefault();
		  	$(this).closest('tr').remove();
		});
		$('#registrar_horario').submit(function() {
			valor = '';
			valor_iguales = '';
			$("input[name='horario_imagen[]']").each( function(){
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